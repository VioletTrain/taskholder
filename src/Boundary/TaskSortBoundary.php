<?php

namespace Taskholder\Boundary;

use Taskholder\Entity\Task;
use Taskholder\Exception\BoundaryException;

class TaskSortBoundary
{
    private string $sort;

    private string $order;

    /**
     * TaskSortBoundary constructor.
     * @param string $sort
     * @param string $order
     * @throws BoundaryException
     */
    public function __construct(string $sort, string $order)
    {
        $this->validate($sort, $order);

        $this->sort = $sort;
        $this->order = $order;
    }

    /**
     * @param string $sort
     * @param string $order
     * @throws BoundaryException
     */
    private function validate(string $sort, string $order): void
    {
        if (!in_array($sort, Task::orderable())) {
            throw new BoundaryException('Tasks may be ordered only by ' . implode(', ', Task::orderable()) . ' fields');
        }

        if (mb_strtolower($order) !== 'asc' && mb_strtolower($order) !== 'desc') {
            throw new BoundaryException('Order may be only ask or desc');
        }
    }

    public function getSort(): string
    {
        return $this->sort;
    }

    public function getOrder(): string
    {
        return $this->order;
    }


}