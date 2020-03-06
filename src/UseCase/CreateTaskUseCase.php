<?php

namespace Taskholder\UseCase;

use Framework\Contract\EntityManager;
use Symfony\Component\HttpFoundation\ParameterBag;
use Taskholder\Boundary\EmailBoundary;
use Taskholder\Boundary\UsernameBoundary;
use Taskholder\Entity\Task;
use Taskholder\Image;
use Taskholder\ImageHandler;

class CreateTaskUseCase
{
    private ImageHandler $imageHandler;
    private EntityManager $em;

    public function __construct(ImageHandler $imageHandler, EntityManager $em)
    {
        $this->imageHandler = $imageHandler;
        $this->em = $em;
    }

    /**
     * @param ParameterBag $properties
     * @return Task
     * @throws \Taskholder\Exception\BoundaryException
     */
    public function createTask(ParameterBag $properties): Task
    {
        $imgName = $this->imageHandler->upload(new Image($properties->get('image')));

        $task = new Task(
            new UsernameBoundary($properties->get('username')),
            new EmailBoundary($properties->get('email')),
            $properties->get('content'),
            $imgName
        );

        $this->em->persist($task);
        $this->em->flush();

        return $task;
    }
}