<?php

namespace Framework;

use Framework\Http\Request;
use Framework\Http\Response;

interface Action
{
    public function execute(Request $request): Response;
}