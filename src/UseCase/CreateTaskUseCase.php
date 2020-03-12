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
        if ($imageData = $properties->get('image')) {
            $image = new Image($imageData);
            $imgName = $this->imageHandler->upload($image)->getName();
        }

        $task = new Task(
            new UsernameBoundary($properties->get('username')),
            new EmailBoundary($properties->get('email')),
            $properties->get('content'),
            $imgName ?? ''
        );

        $this->em->persist($task);
        $this->em->flush();

        return $task;
    }
}