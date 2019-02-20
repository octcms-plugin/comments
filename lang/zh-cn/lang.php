<?php

return [
    'plugin' => [
        'name' => '评论扩展',
        'description' => 'Comments评论插件的扩展, 增加文章评论数和评论列表组件',
    ],
    'settings' => [
        'label' => '评论扩展',
        'description' => '管理设置',
        'post_url_prefix' => '文章URL前缀',
        'post_url_prefix_comment' => '文章详情页面URL相对路径前缀, 如："blog/"、"blog/post/"、"article/"等'
    ],
    'sorting' => [
        'id_asc' => 'ID (顺序)',
        'id_desc' => 'ID (倒序)',
        'created_asc' => '创建时间 (顺序)',
        'created_desc' => '创建时间 (倒序)',
        'random' => '随机'
    ],
    'components' => [
        'name' => '评论列表',
        'description' => '在页面显示评论列表.',
        'url_filter_title' => 'URL过滤',
        'url_filter_description' => '不填写具体URL等于不过滤任何评论',
        'limit_title' => '数量',
        'limit_description' => '评论显示数量, 等于0显示全部评论',
        'limit_validation_message' => '只能是数字',
        'order_title' => '排序',
        'order_description' => '评论排序规则'
    ]
];
