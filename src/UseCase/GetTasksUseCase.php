<?php

namespace Taskholder\UseCase;

use Framework\Contract\EntityManager;
use Taskholder\Boundary\TaskSortBoundary;
use Taskholder\Entity\Task;

class GetTasksUseCase
{
    private EntityManager $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getTasks(TaskSortBoundary $boundary, int $currentPage): array
    {
        $perPage = 3;

        return $this->em->select('t')
            ->from(Task::class, 't')
            ->orderBy('t.' . 'id', $boundary->getOrder())
            ->paginate($perPage, $currentPage);
    }
}