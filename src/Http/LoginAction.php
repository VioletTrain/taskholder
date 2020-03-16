<?php

namespace Taskholder\Http;

use Framework\Action;
use Framework\Authenticator;
use Framework\Http\Request;
use Framework\Http\Response;
use Taskholder\Entity\Admin;

class LoginAction implements Action
{
    private Authenticator $authenticator;

    public function __construct(Authenticator $authenticator)
    {
        $this->authenticator = $authenticator;
    }

    public function execute(Request $request): Response
    {
        $login = (string) $request->post('login') ?? '';
        $password = (string) $request->post('password') ?? '';

        $admin = $this->authenticator->setSubject(Admin::class)
            ->attempt($login, $password);

        return new Response([
            'admin' => $admin
        ]);
    }
}