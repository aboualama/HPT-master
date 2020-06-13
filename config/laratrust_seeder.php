<?php

return [
    'role_structure' => [
        'admin' => [
            'users'       => 'c,r,u,d',
            'Licensecode' => 'c,r,u,d',
            'questions'   => 'c,r,u,d',
        ],
        'azienda' => [
            'users'       => 'r,u',
            'Licensecode' => 'r',
            'questions'   => 'r',
        ],
        'user' => [
            'users'       => 'r,u',
            'Licensecode' => 'r',
            'questions'   => 'r',
        ],
    ],


    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
