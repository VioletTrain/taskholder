<?php

namespace Taskholder\Http;

use Framework\Action;
use Framework\Http\Request;
use Framework\Http\Response;

class CreateTaskAction implements Action
{
    public function execute(Request $request): Response
    {
        return new Response('test');
    }
}