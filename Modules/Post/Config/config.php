<?php

return [
    'name' => 'Posts',
    /**
     * Always use lower name without custom characters, spaces, etc
     */
    'permissions' => [
        'posts.settings',
        'posts.browse',
        'posts.create',
        'posts.update',
        'posts.destroy'
    ]
];
