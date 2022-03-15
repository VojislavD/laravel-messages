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
    public function test_validation()
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
}
