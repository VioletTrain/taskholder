<?php

namespace Taskholder\UseCase;

use Doctrine\ORM\EntityManagerInterface;
use Framework\Exception\ApplicationException;
use Taskholder\Boundary\EmailBoundary;
use Taskholder\Boundary\ImageBoundary;
use Taskholder\Boundary\UsernameBoundary;
use Taskholder\Entity\Task;
use Taskholder\ImageHandler;

class CreateTaskUseCase
{
    private ImageHandler $imageHandler;
    private EntityManagerInterface $em;

    public function __construct(ImageHandler $imageHandler, EntityManagerInterface $em)
    {
        $this->imageHandler = $imageHandler;
        $this->em = $em;
    }

    /**
     * @param string $username
     * @param string $email
     * @param string $content
     * @param $image
     * @return Task
     * @throws ApplicationException
     */
    public function createTask(string $username, string $email, string $content, $image): Task
    {
        $imgPath = $this->imageHandler->upload($image);

        $task = new Task(
            new UsernameBoundary($username),
            new EmailBoundary($email),
            $content,
            new ImageBoundary($imgPath)
        );

        $this->em->persist($task);
        $this->em->flush();

        return $task;
    }
}