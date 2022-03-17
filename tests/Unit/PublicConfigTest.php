<?php

namespace VojislavD\LaravelMessages\Tests\Unit;

use Illuminate\Support\Facades\File;
use VojislavD\LaravelMessages\Tests\TestCase;

class PublishConfigTest extends TestCase
{
    /** @test */
    public function test_publish_config_when_not_exists()
    {
        $this->assertFalse(file_exists(config_path('messages.php')));
        
        $this->artisan('vendor:publish --tag="laravel-messages-config"');

        $this->assertTrue(file_exists(config_path('messages.php')));

        $this->assertEquals(
            file_get_contents(__DIR__.'/../../config/messages.php'),
            file_get_contents(config_path('messages.php'))
        );
    }

    /** @test */
    public function test_publish_config_when_already_exists()
    {
        $this->assertFalse(file_exists(config_path('messages.php')));
        
        File::put(config_path('messages.php'), 'Config test');

        $this->artisan('vendor:publish --tag="laravel-messages-config"');

        $this->assertTrue(file_exists(config_path('messages.php')));

        $this->assertEquals(
            'Config test',
            file_get_contents(config_path('messages.php'))
        );
    }
}