<?php

namespace VojislavD\LaravelMessages\Tests\Feature;

use VojislavD\LaravelMessages\Actions\CreateMessage;
use VojislavD\LaravelMessages\Tests\TestCase;

class CreateMessageActionTest extends TestCase
{
    /** @test */
    public function test_create_message()
    {
        $this->actingAs($this->testUser);

        $creator = new CreateMessage();
        $creator($this->testThread, 'Message for testing');

        $this->assertDatabaseHas('messages', [
            'thread_id' => $this->testThread->id,
            'user_id' => auth()->id(),
            'body' => 'Message for testing',
            'seen_at' => null
        ]);
    }
}