<?php

namespace VojislavD\LaravelMessages\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use VojislavD\LaravelMessages\Actions\CreateMessage;
use VojislavD\LaravelMessages\Tests\TestCase;

class CreateMessageActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_create_message()
    {
        $this->actingAs($this->testUser);

        $creator = new CreateMessage();
        $creator($this->testThread, 'Test message');

        $this->assertDatabaseHas('messages', [
            'thread_id' => $this->testThread->id,
            'user_id' => auth()->id(),
            'body' => 'Test message',
            'seen_at' => null
        ]);
    }
}