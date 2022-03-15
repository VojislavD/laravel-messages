<?php

namespace VojislavD\LaravelMessages\Tests;

use VojislavD\LaravelMessages\Providers\LaravelMessagesServiceProvider;
use Livewire\LivewireServiceProvider;
use VojislavD\LaravelMessages\Traits\Migrations;

class TestCase extends \Orchestra\Testbench\TestCase
{
    use Migrations;
    
    public function setUp(): void
    {
        parent::setUp();
        $this->cleanState();

    }

    public function tearDown(): void
    {
        parent::tearDown();
        $this->cleanState();
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

    private function cleanState()
    {
        $migrations = scandir(database_path('migrations'));
        
        foreach ($migrations as $migration) {
            if ($migration === '.' || $migration === '..' || $migration === '.gitkeep') {
                continue;
            }

            unlink(database_path('migrations').'/'. $migration);
        }
    }
}