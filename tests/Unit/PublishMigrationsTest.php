<?php

namespace VojislavD\LaravelMessages\Tests\Unit;

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
        $this->assertContains('create_thread_participants_table.php', $migrations);
        $this->assertContains('create_messages_table.php', $migrations);
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