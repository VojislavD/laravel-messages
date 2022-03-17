<?php

namespace VojislavD\LaravelMessages\Tests\Feature;

use VojislavD\LaravelMessages\Actions\CreateThread;
use VojislavD\LaravelMessages\Tests\TestCase;

class CreateThreadActionTest extends TestCase
{
    /** @test */
    public function test_create_thread()
    {
        $this->actingAs($this->testUser);

        $this->assertDatabaseCount('threads', 1);
        $this->assertDatabaseCount('thread_user', 2);

        $creator = new CreateThread();
        $creator([
            'email' => $this->anotherTestUser->email,
            'body' => 'Message for testing creating thread'
        ]);

        $this->assertDatabaseCount('threads', 2);
        $this->assertDatabaseCount('thread_user', 4);

        $this->assertDatabaseHas('messages', [
            'user_id' => auth()->id(),
            'body' => 'Message for testing creating thread',
            'seen_at' => null
        ]);
    }
}