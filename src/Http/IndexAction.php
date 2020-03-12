<?php

namespace Taskholder\Http;

use Framework\Action;
use Framework\Http\Request;
use Framework\Http\Response;
use Taskholder\Boundary\TaskSortBoundary;
use Taskholder\UseCase\GetTasksUseCase;
use Twig\Environment;

class IndexAction implements Action
{
    private Environment $twig;

    private GetTasksUseCase $useCase;

    public function __construct(Environment $twig, GetTasksUseCase $useCase)
    {
        $this->twig = $twig;
        $this->useCase = $useCase;
    }

    public function execute(Request $request): Response
    {
        $sort = $request->get('sort') ?? 'created_at';
        $order = $request->get('order') ?? 'desc';
        $currentPage = (int) $request->get('current_page') === 0 ? 1 : $request->get('current_page');

        $tasks = $this->useCase->getTasks(new TaskSortBoundary($sort, $order), $currentPage);

        return new Response($this->twig->render('index.html', [
            'tasks' => $tasks
        ]));
    }
}