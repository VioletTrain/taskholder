<?php

namespace Taskholder\UseCase;

use Framework\Contract\EntityManager;
use Framework\Exception\ApplicationException;
use Framework\Library\Image\ImageHandler;
use Symfony\Component\HttpFoundation\ParameterBag;
use Taskholder\Boundary\EmailBoundary;
use Taskholder\Boundary\UsernameBoundary;
use Taskholder\Entity\Task;
use Taskholder\Image;

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
     * @throws ApplicationException
     */
    public function createTask(ParameterBag $properties): Task
    {
        $image = new Image($properties->get('image'));
        $this->imageHandler->upload($image);

        $task = new Task(
            new UsernameBoundary($properties->get('username')),
            new EmailBoundary($properties->get('email')),
            $properties->get('content'),
            $image->getName()
        );

        $this->em->persist($task);
        $this->em->flush();

        return $task;
    }
}