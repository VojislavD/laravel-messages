<?php

namespace VojislavD\LaravelMessages\Tests\Unit;

use Illuminate\Support\Facades\File;
use VojislavD\LaravelMessages\Tests\TestCase;

class PublishViewsTest extends TestCase
{
    /** @test */
    public function test_publish_views_when_not_exists()
    {
        mkdir(resource_path('views/vendor/laravel-messages'), 0777, true);

        $this->assertFalse(file_exists(resource_path('views/vendor/laravel-messages/inbox.blade.php')));
        
        $this->artisan('vendor:publish --tag="laravel-messages-views"');

        $this->assertTrue(file_exists(resource_path('views/vendor/laravel-messages/inbox.blade.php')));

        $this->assertEquals(
            file_get_contents(__DIR__.'/../../resources/views/livewire/inbox.blade.php'),
            file_get_contents(resource_path('views/vendor/laravel-messages/inbox.blade.php'))
        );
    }

    /** @test */
    public function test_publish_views_when_already_exists()
    {
        mkdir(resource_path('views/vendor/laravel-messages'), 0777, true);

        $this->assertFalse(file_exists(resource_path('views/vendor/laravel-messages/inbox.blade.php')));
        
        File::put(resource_path('views/vendor/laravel-messages/').'inbox.blade.php', 'Views test');

        $this->artisan('vendor:publish --tag="laravel-messages-views"');

        $this->assertTrue(file_exists(resource_path('views/vendor/laravel-messages/inbox.blade.php')));

        $this->assertEquals(
            'Views test',
            file_get_contents(resource_path('views/vendor/laravel-messages/inbox.blade.php'))
        );
    }
}