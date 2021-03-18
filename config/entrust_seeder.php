<?php

return [
    'role_structure' => [
        'admin' => [
            'teams' => 'c,r,u,d',
            'players' => 'c,r,u,d',
            'statistics' => 'c,r,u,d'
        ],
        'coach' => [
            'teams' => 'c,r,u,d',
            'players' => 'c,r,u,d',
        ],
        'team_manager' => [
            'teams' => 'c,r',
            'players' => 'c,r,u,d',
        ],
        'player' => [
            'profile' => 'r,d'
        ]
    ],
    'user_roles' => [
        'admin' => [
            ['name' => "Admin", "email" => "admin@afl.com", "password" => 'admin123'],
        ],
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ],
];