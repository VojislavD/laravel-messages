<?php

namespace VojislavD\LaravelMessages\Tests\Unit;

use Livewire\Livewire;
use VojislavD\LaravelMessages\Tests\TestCase;

class FilterWordsTest extends TestCase
{
    /** @test */
    public function test_filter_exact_words()
    {
        $this->actingAs($this->testUser);

        config(['messages.validation.filter.exact' => ['mock']]);

        Livewire::test('inbox')
            ->set('thread', $this->testThread)
            ->set('state.body', 'Some text goes here and than forbidden word ' . config('messages.validation.filter.exact')[0] . ' and after that more text.')
            ->call('submit')
            ->assertHasErrors();

        Livewire::test('inbox')
            ->set('thread', $this->testThread)
            ->set('state.body', 'Some text goes here and than forbidden word' . config('messages.validation.filter.exact')[0] . 'and after that more text.')
            ->call('submit')
            ->assertHasNoErrors();

    }

    /** @test */
    public function test_filter_contain_words()
    {
        $this->actingAs($this->testUser);

        config(['messages.validation.filter.contain' => ['mock']]);

        Livewire::test('inbox')
            ->set('thread', $this->testThread)
            ->set('state.body', 'Some text goes here and than forbidden word ' . config('messages.validation.filter.contain')[0] . ' and after that more text.')
            ->call('submit')
            ->assertHasErrors();

        Livewire::test('inbox')
            ->set('thread', $this->testThread)
            ->set('state.body', 'Some text goes here and than forbidden word' . config('messages.validation.filter.contain')[0] . 'and after that more text.')
            ->call('submit')
            ->assertHasErrors();

    }
}
