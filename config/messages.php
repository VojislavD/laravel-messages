<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Automatically Update Component
    |--------------------------------------------------------------------------
    | 
    | This option controls if the component should automatically reload and 
    | update messages and how often it should do that.
    |
    */
    'update' => [
        'auto' => false,
        'interval' => 750 // milliseconds
    ],

    /*
    |--------------------------------------------------------------------------
    | Filter Messages For Forbidden Words
    |--------------------------------------------------------------------------
    |
    | This option filters messages for forbidden words or text. You can check if the 
    | message has some exact word, or you can check if the message contains 
    | some forbidden text.
    |
    */
    'validation' => [
        'filter' => [
            'exact' => [],
            'contain' => [],
        ],
    ],
];
