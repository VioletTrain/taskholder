<?php

namespace Taskholder\Http;

use Framework\Action;
use Framework\Http\Request;
use Framework\Http\Response;
use Twig\Environment;

class LoginFormAction implements Action
{
    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function execute(Request $request): Response
    {
        return new Response($this->twig->render('login.html'));
    }
}