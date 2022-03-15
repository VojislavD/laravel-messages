<?php

namespace VojislavD\LaravelMessages\Rules;

use Illuminate\Contracts\Validation\Rule;

class FilterWords implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $exact = config('messages.validation.filter.exact');
        $contain = config('messages.validation.filter.contain');

        if (empty($exact) && empty($contain)) {
            return true;
        }

        $words = explode(' ', $value);

        if (!empty($exact)) {
            foreach ($words as $word) {
                if (in_array($word, $exact)) {
                    return false;
                }
            }
        }

        if (!empty($contain)) {
            foreach ($contain as $containWord) {
                if (str_contains($value, $containWord)) {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute have one or more forbidden words.';
    }
}
