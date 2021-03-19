<?php

return [
    'role_structure' => [
        'admin' => [
            'teams' => 'c,r,u,d,l',
            'players' => 'c,r,u,d,l',
            'statistics' => 'c,r,u,d,l'
        ],
        'coach' => [
            'teams' => 'c,r,u,d,l',
            'players' => 'c,r,u,d,l',
        ],
        'team_manager' => [
            'teams' => 'c,r,l',
            'players' => 'c,r,u,d,l',
        ],
        'player' => [
            'statistics' => 'c,r,u,l'
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
        'l' => 'list'
    ],
];