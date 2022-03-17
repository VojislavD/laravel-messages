<?php

namespace VojislavD\LaravelMessages\Contracts;

interface CreatesThread
{
    public function __invoke(array $params);
}