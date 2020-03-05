<?php

namespace Framework\Exception;

use Framework\Http\Response;
use Throwable;

class Handler
{
    public function handle(Throwable $e)
    {
        $this->render($e);
    }

    private function render(Throwable $e)
    {
        $response = $e instanceof ApplicationException
            ? new Response(['error' => $e->getMessage()], $e->getCode())
            : new Response(['error' => $e->getMessage() . "\n<br>" . $e->getTraceAsString()], 500);

        $response->send();
    }
}