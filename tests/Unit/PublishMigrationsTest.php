<?php

namespace VojislavD\LaravelMessages\Tests\Unit;

use Illuminate\Support\Facades\File;
use VojislavD\LaravelMessages\Tests\TestCase;

class PublishMigrationsTest extends TestCase
{
    /** @test */
    public function test_publish_migrations_when_not_already_exists()
    {
        $this->assertEmpty($this->migrations());

        $this->artisan('vendor:publish --tag="laravel-messages-migrations"');

        $migrations = $this->migrations();

        $this->assertCount(3, $migrations);
        $this->assertContains('create_threads_table.php', $migrations);
        $this->assertContains('create_thread_user_table.php', $migrations);
        $this->assertContains('create_messages_table.php', $migrations);

        $content = scandir(database_path('migrations'));

        $this->assertEquals(
            file_get_contents(__DIR__.'/../../database/migrations/create_threads_table.stub'),
            file_get_contents(database_path('migrations/'.$content[3]))
        );

        $this->assertEquals(
            file_get_contents(__DIR__.'/../../database/migrations/create_thread_user_table.stub'),
            file_get_contents(database_path('migrations/'.$content[4]))
        );

        $this->assertEquals(
            file_get_contents(__DIR__.'/../../database/migrations/create_messages_table.stub'),
            file_get_contents(database_path('migrations/'.$content[5]))
        );
    }

    /** @test */
    public function test_publish_migrations_when_already_exists()
    {
        $threadsTable = date('Y_m_d_His', time()). '_create_threads_table.php';
        $threadParticipants = date('Y_m_d_His', time()+1). '_create_thread_user_table.php';
        $messagesTable = date('Y_m_d_His', time()+2). '_create_messages_table.php';

        File::put(database_path('migrations/'. $threadsTable), 'Threads table');
        File::put(database_path('migrations/'. $threadParticipants), 'Thread participants table');
        File::put(database_path('migrations/'. $messagesTable), 'Messages table');

        $this->artisan('vendor:publish --tag="laravel-messages-migrations"');

        $migrations = $this->migrations();

        $this->assertCount(3, $migrations);

        $this->assertEquals(
            "Threads table",
            file_get_contents(database_path('migrations/'.$threadsTable))
        );

        $this->assertEquals(
            "Thread participants table",
            file_get_contents(database_path('migrations/'.$threadParticipants))
        );

        $this->assertEquals(
            "Messages table",
            file_get_contents(database_path('migrations/'.$messagesTable))
        );
    }

    private function migrations()
    {
        $migrations = $this->existingMigrations();

        foreach ($migrations as $key => $migration) {
            if (empty($migration)) {
                unset($migrations[$key]);
            }
        }

        return $migrations;
    }
}