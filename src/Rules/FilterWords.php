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
        $config = $this->getConfig();

        if (empty($config['exact']) && empty($config['contain'])) {
            return true;
        }

        $words = explode(' ', $value);

        if (!empty($config['exact'])) {
            foreach ($words as $word) {
                if (in_array($word, $config['exact'])) {
                    return false;
                }
            }
        }

        if (!empty($config['contain'])) {
            foreach ($config['contain'] as $containWord) {
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

    private function getConfig()
    {
        $config = [];

        if (file_exists(config_path('messages.php'))) {
            $config['exact'] = config('messages.validation.filter.exact');
            $config['contain'] = config('messages.validation.filter.contain');
        } else {
            $messages = require_once(__DIR__.'/../../config/messages.php');

            $config['exact'] = $messages['validation']['filter']['exact'];
            $config['contain'] = $messages['validation']['filter']['contain'];
        }

        return $config;
    }
}
