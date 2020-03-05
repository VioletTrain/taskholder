<?php

namespace Taskholder\UseCase;

use Framework\Contract\EntityManager;
use Symfony\Component\HttpFoundation\ParameterBag;
use Taskholder\Boundary\BoolBoundary;
use Taskholder\Boundary\IntBoundary;
use Taskholder\Boundary\StringBoundary;
use Taskholder\Entity\Task;
use Taskholder\Exception\EntityNotFoundException;
use Throwable;

class EditTaskUseCase
{
    private EntityManager $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param ParameterBag $properties
     * @return Task
     * @throws Throwable
     */
    public function editTask(ParameterBag $properties): Task
    {
        $id = new IntBoundary($properties->get('id'));

        $task = $this->em->find(Task::class, $id->getInteger());

        if (!$task) {
            throw new EntityNotFoundException("Task with id {$id->getInteger()} was not found");
        }

        $task->setContent(new StringBoundary($properties->get('content')))
            ->setCompleted(new BoolBoundary($properties->get('completed')));

        $this->em->persist($task);
        $this->em->flush();

        return $task;
    }
}