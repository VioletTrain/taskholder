<?php

namespace Framework\Contract;

interface Authenticatable
{
    public function getLogin(): string;

    public function getPassword(): string;
}