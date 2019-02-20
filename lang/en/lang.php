<?php

return [
    'plugin' => [
        'name' => 'Comments Extensions',
        'description' => 'Comments extensions. Number of comments on blog posts. List of comments.',
    ],
    'settings' => [
        'label' => 'Comments Extensions',
        'description' => 'Manage Settings.',
        'post_url_prefix' => 'Post Url Prefix',
        'post_url_prefix_comment' => 'Prefix in post url. (e.g. "blog/", "blog/post/", "article/".)'
    ],
    'sorting' => [
        'id_asc' => 'ID (ascending)',
        'id_desc' => 'ID (descending)',
        'created_asc' => 'Created (ascending)',
        'created_desc' => 'Created (descending)',
        'random' => 'Random'
    ],
    'components' => [
        'name' => 'Comments List',
        'description' => 'Displays a list of comments on the page.',
        'url_filter_title' => 'URL Filter',
        'url_filter_description' => 'If empty, no filter comments.',
        'limit_title' => 'Limit',
        'limit_description' => 'Number of comments to display, 0 retrieves all comments.',
        'limit_validation_message' => 'Limit of comments must be a valid non-negative integer number.',
        'order_title' => 'Comments order',
        'order_description' => 'How comments should be ordered.'
    ]
];
