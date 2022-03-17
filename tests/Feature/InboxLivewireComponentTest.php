<?php

namespace VojislavD\LaravelMessages\Tests\Feature;

use Livewire\Livewire;
use VojislavD\LaravelMessages\Tests\TestCase;

class InboxLivewireComponentTest extends TestCase
{
    /** @test */
    public function test_component_load_correct_data()
    {
        $this->actingAs($this->testUser);

        Livewire::test('inbox')
            ->assertHasNoErrors()
            ->assertSee($this->anotherTestUser->name);
    }

    /** @test */
    public function test_mark_messages_as_seen()
    {
        $this->actingAs($this->testUser);

        foreach ($this->testThread->messages() as $message) {
            $this->assertDatabaseHas('messages', [
                'id' => $message->id,
                'seen_at' => null
            ]);
        }

        Livewire::test('inbox')
            ->call('selectThread', $this->testThread);

        foreach ($this->testThread->messages() as $message) {
            $this->assertDatabaseHas('messages', [
                'id' => $message->id,
                'seen_at' => now()->toFormattedDateString()
            ]);
        }
    }

    /** @test */
    public function test_validation_for_new_message()
    {
        $this->actingAs($this->testUser);

        Livewire::test('inbox')
            ->set('thread', $this->testThread)
            ->set('state.body', '')
            ->call('submit')
            ->assertHasErrors([
                'state.body' => 'required'
            ]);

        Livewire::test('inbox')
            ->set('thread', $this->testThread)
            ->set('state.body', 1)
            ->call('submit')
            ->assertHasErrors([
                'state.body' => 'string'
            ]);

        Livewire::test('inbox')
            ->set('thread', $this->testThread)
            ->set('state.body', file_get_contents(__DIR__.'/../helpers/longText.txt'))
            ->call('submit')
            ->assertHasErrors([
                'state.body' => 'max'
            ]);
    }

    /** @test */
    public function test_validation_for_new_thread()
    {
        $this->actingAs($this->testUser);

        Livewire::test('inbox')
            ->set('state.email', '')
            ->set('state.body', '')
            ->call('newMessageSubmit')
            ->assertHasErrors([
                'state.body' => 'required',
                'state.email' => 'required'
            ]);

        Livewire::test('inbox')
            ->set('state.email', 'notvalidemail')
            ->set('state.body', 1)
            ->call('newMessageSubmit')
            ->assertHasErrors([
                'state.email' => 'email',
                'state.body' => 'string'
            ]);

        Livewire::test('inbox')
            ->set('state.email', 'notexistingemail@example.com')
            ->set('state.body', file_get_contents(__DIR__.'/../helpers/longText.txt'))
            ->call('newMessageSubmit')
            ->assertHasErrors([
                'state.email' => 'exists',
                'state.body' => 'max'
            ]);

        Livewire::test('inbox')
            ->set('state.email', $this->anotherTestUser->email)
            ->set('state.body', 'Some body for message')
            ->call('newMessageSubmit')
            ->assertHasNoErrors();
    }

    /** @test */
    public function test_create_new_message()
    {
        $this->actingAs($this->testUser);

        Livewire::test('inbox')
            ->set('thread', $this->testThread)
            ->set('state.body', 'Message created from test.')
            ->call('submit')
            ->assertHasNoErrors();


        $this->assertDatabaseHas('messages', [
            'body' => 'Message created from test.',
        ]);
    }

    /** @test */
    public function test_create_new_thread()
    {
        $this->actingAs($this->testUser);

        $this->assertDatabaseCount('threads', 1);
        $this->assertDatabaseCount('thread_user', 2);

        Livewire::test('inbox')
            ->set('state.email', $this->anotherTestUser->email)
            ->set('state.body', 'Message created from test for new thread')
            ->call('newMessageSubmit')
            ->assertHasNoErrors();

        $this->assertDatabaseCount('threads', 2);
        $this->assertDatabaseCount('thread_user', 4);

        $this->assertDatabaseHas('messages', [
            'user_id' => auth()->id(),
            'body' => 'Message created from test for new thread',
            'seen_at' => null
        ]);
    }
}
