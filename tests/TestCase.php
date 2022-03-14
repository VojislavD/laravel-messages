<?php

namespace VojislavD\LaravelMessages\Tests;

use VojislavD\LaravelMessages\Providers\LaravelMessagesServiceProvider;
use Livewire\LivewireServiceProvider;

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
            LivewireServiceProvider::class,
            LaravelMessagesServiceProvider::class
        ];
    }
}