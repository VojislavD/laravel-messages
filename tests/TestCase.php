<?php

namespace VojislavD\LaravelMessages\Tests;

use Illuminate\Database\Schema\Blueprint;
use VojislavD\LaravelMessages\Providers\LaravelMessagesServiceProvider;
use Livewire\LivewireServiceProvider;
use VojislavD\LaravelMessages\Models\Message;
use VojislavD\LaravelMessages\Models\Thread;
use VojislavD\LaravelMessages\Models\User;
use VojislavD\LaravelMessages\Traits\Migrations;

class TestCase extends \Orchestra\Testbench\TestCase
{
    use Migrations;
    
    protected $testUser;

    protected $testThread;

    protected $testMessage;

    public function setUp(): void
    {
        parent::setUp();
        $this->cleanState();
        $this->setUpDatabase($this->app);
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

    protected function setUpDatabase($app)
    {
        $app['db']->connection()->getSchemaBuilder()->create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });

        $app['db']->connection()->getSchemaBuilder()->create('threads', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        $app['db']->connection()->getSchemaBuilder()->create('thread_participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('thread_id');
            $table->foreignId('user_id');
            $table->timestamps();
        });

        $app['db']->connection()->getSchemaBuilder()->create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('thread_id');
            $table->foreignId('user_id');
            $table->text('body');
            $table->timestamp('seen_at')->nullable();
            $table->timestamps();
        });

        $this->testUser = User::create([
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        $this->testThread = Thread::create();

        $this->testMessage = Message::create([
            'thread_id' => $this->testThread->id,
            'user_id' => $this->testUser->id,
            'body' => 'Test Message'
        ]);
    }
}