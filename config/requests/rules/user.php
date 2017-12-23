<?php

return [
    'create' => [
        'name' => [
            'required',
            'unique:users,name',
            'alpha_num',
            'min:6'
        ],
        'email' => [
            'required',
            'unique:users,email',
            'email',
        ],
        'password' => [
            'required',
            'alpha_num',
            'min:8',
        ],
    ],
];
