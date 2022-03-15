<?php

return [
    'update' => [
        'auto' => false,
        'time' => 750 // milliseconds
    ],
    'validation' => [
        'filter' => [
            'exact' => ['exact_word'],
            'contain' => ['contain_word'],
        ],
    ],
];
