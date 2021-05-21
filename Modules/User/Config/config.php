<?php

return [
    'name' => 'Users',
    /**
     * Always use lower name without custom characters, spaces, etc
     */
    'permissions' => [
        'users.settings',
        'users.browse',
        'users.create',
        'users.update',
        'users.destroy'
    ]
];
