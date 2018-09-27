<?php

declare(strict_types=1);

return [
    'doctrine' => [
        'configuration' => [
            'orm_default' => [
                'result_cache' => 'array',
                'metadata_cache' => 'array',
                'query_cache' => 'array',
                'hydration_cache' => 'array',
            ],
        ],
        'driver' => [
            'user_entities' => [
                'cache' => 'array',
            ],
            'oauth_entities' => [
                'cache' => 'array',
            ],
            'auction_entities' => [
                'cache' => 'array',
            ],
        ],
    ],
];
