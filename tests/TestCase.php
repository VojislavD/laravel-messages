<?php

namespace VojislavD\LaravelMessages\Tests;

use VojislavD\LaravelMessages\Providers\LaravelMessagesServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function getEnvironmentSetUp($app)
    {
        
    }

    public function getPackageProviders($app)
    {
        return [
            LaravelMessagesServiceProvider::class
        ];
    }
}