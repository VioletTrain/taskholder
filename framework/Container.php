<?php

namespace Framework;

use Closure;
use Framework\Exception\BindingException;
use ReflectionClass;
use ReflectionException;
use ReflectionParameter;

class Container
{
    private array $bindings;

    private array $singletons;

    private array $resolved;

    public function __construct()
    {
        $this->resolved[Container::class] = $this;
    }

    /**
     * @param string $abstract
     * @param $concrete
     * @return self
     */
    public function bind(string $abstract, $concrete): self
    {
        $this->bindings[$abstract] = $concrete;

        return $this;
    }

    public function singleton(string $abstract, $concrete): self
    {
        $this->singletons[$abstract] = $concrete;

        return $this;
    }

    /**
     * @param string $class
     * @param $parameters
     * @return mixed
     * @throws BindingException
     */
    public function make(string $class, $parameters = [])
    {
        try {
            return $this->resolve($class, $parameters);
        } catch (ReflectionException $e) {
            throw new BindingException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param string $class
     * @param $parameters
     * @return mixed
     * @throws BindingException
     * @throws ReflectionException
     */
    private function resolve(string $class, $parameters = [])
    {
        if ($this->isSingleton($class)) {
            return $this->resolveSingleton($class, $parameters);
        }

        if (!isset($this->bindings[$class])) {
            return $this->build($class, $parameters);
        }

        return $this->build($this->bindings[$class], $parameters);
    }

    private function isSingleton(string $abstract): bool
    {
        return isset($this->singletons[$abstract]);
    }

    /**
     * @param string $abstract
     * @param $parameters
     * @return mixed
     * @throws BindingException
     * @throws ReflectionException
     */
    private function resolveSingleton(string $abstract, $parameters = [])
    {
        if (!isset($this->resolved[$abstract])) {
            $this->resolved[$abstract] = $this->build($this->singletons[$abstract], $parameters);
        }

        return $this->resolved[$abstract];
    }

    /**
     * @param $concrete
     * @param $parameters
     * @return mixed
     * @throws BindingException
     * @throws ReflectionException
     */
    private function build($concrete, $parameters = [])
    {
        if ($concrete instanceof Closure) {
            return $concrete($parameters);
        }
        try {
            $reflector = new ReflectionClass($concrete);
        } catch (ReflectionException $e) {
            throw new BindingException($e->getMessage());
        }

        if (!$reflector->isInstantiable()) {
            throw new BindingException();
        }

        $constructor = $reflector->getConstructor();

        if (is_null($constructor)) {
            return new $concrete();
        }

        $dependencies = $constructor->getParameters();
        $instances = $this->resolveDependencies($dependencies);

        return $reflector->newInstanceArgs($instances);
    }

    /**
     * @param array $dependencies
     * @return array
     * @throws BindingException
     * @throws ReflectionException
     */
    private function resolveDependencies(array $dependencies): array
    {
        $results = [];

        foreach ($dependencies as $dependency) {
            $results[] = is_null($dependency->getClass())
                ? $this->resolvePrimitive($dependency)
                : $this->resolveClass($dependency);
        }

        return $results;
    }

    /**
     * @param ReflectionParameter $primitive
     * @return mixed
     * @throws BindingException
     * @throws ReflectionException
     */
    private function resolvePrimitive(ReflectionParameter $primitive)
    {
        if ($primitive->isDefaultValueAvailable()) {
            return $primitive->getDefaultValue();
        }

        throw new BindingException("Can not resolve $primitive of {$primitive->getDeclaringClass()->getName()}" );
    }

    /**
     * @param ReflectionParameter $class
     * @return mixed
     * @throws BindingException
     * @throws ReflectionException
     */
    private function resolveClass(ReflectionParameter $class)
    {
        try {
            return $this->make($class->getClass()->getName());
        } catch (BindingException $e) {
            if ($class->isOptional()) {
                return $class->getDefaultValue();
            }

            throw $e;
        }
    }
}