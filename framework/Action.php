<?php

namespace Framework;

use Framework\Http\Request;
use Framework\Http\Response;
use Throwable;

interface Action
{
    /**
     * @param Request $request
     * @return Response
     * @throws Throwable
     */
    public function execute(Request $request): Response;
}