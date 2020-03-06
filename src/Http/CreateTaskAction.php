<?php

namespace Taskholder\Http;

use Framework\Action;
use Framework\Http\Request;
use Framework\Http\Response;
use Taskholder\UseCase\CreateTaskUseCase;

class CreateTaskAction implements Action
{
    private CreateTaskUseCase $useCase;

    public function __construct(CreateTaskUseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    public function execute(Request $request): Response
    {
        $task = $this->useCase->createTask($request->all());

        return new Response([
            'task' => $task
        ]);
    }
}