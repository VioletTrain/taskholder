<?php

namespace Taskholder\Http;

use Framework\Action;
use Framework\Authenticator;
use Framework\Contract\Authenticatable;
use Framework\Http\Request;
use Framework\Http\Response;
use Taskholder\UseCase\EditTaskUseCase;

class EditTaskAction implements Action
{
    private EditTaskUseCase $useCase;
    private Authenticatable $admin;

    /**
     * EditTaskAction constructor.
     * @param EditTaskUseCase $useCase
     * @param Authenticator $authenticator
     * @throws \Framework\Exception\AuthorizationException
     */
    public function __construct(EditTaskUseCase $useCase, Authenticator $authenticator)
    {
        $this->useCase = $useCase;
        $this->admin = $authenticator->user();
    }

    public function execute(Request $request): Response
    {
        return new Response([
            'task' => $this->useCase->editTask($request->all()),
            'admin' => $this->admin,
        ]);
    }
}