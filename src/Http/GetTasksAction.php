<?php

namespace Taskholder\Http;

use Framework\Action;
use Framework\Http\Request;
use Framework\Http\Response;
use Taskholder\Boundary\TaskSortBoundary;
use Taskholder\UseCase\GetTasksUseCase;

class GetTasksAction implements Action
{
    private GetTasksUseCase $useCase;

    public function __construct(GetTasksUseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    public function execute(Request $request): Response
    {
        $sort = $request->get('sort') ?? 'created_at';
        $order = $request->get('order') ?? 'desc';
        $currentPage = (int) $request->get('current_page') === 0 ? 1 : $request->get('current_page');

        return new Response([
            'tasks' => $this->useCase->getTasks(new TaskSortBoundary($sort, $order), $currentPage)
        ]);
    }
}