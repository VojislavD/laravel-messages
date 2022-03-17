<?php

namespace VojislavD\LaravelMessages\Contracts;

interface CreatesThread
{
    /**
     * @param array $params
     * 
     * @return void
     */
    public function __invoke(array $params);
}