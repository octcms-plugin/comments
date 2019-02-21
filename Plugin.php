<?php

namespace Octcms\Comments;

use Octcms\Comments\Models\Settings;
use SaurabhDhariwal\Comments\Models\Comments;
use System\Classes\PluginBase;
use System\Classes\PluginManager;

/**
 * Class Plugin
 * @package Octcms\Comments
 */
class Plugin extends PluginBase
{
    public $require = [
        'SaurabhDhariwal.Comments'
    ];

    public function pluginDetails() {
        return [
            'name' => 'octcms.comments::lang.plugin.name',
            'description' => 'octcms.comments::lang.plugin.description',
            'author' => 'Yikui Shi',
            'icon' => 'icon-comments-o',
            'homepage'    => 'https://github.com/octcms-plugin/comments'
        ];
    }

    /**
     * @return array
     */
    public function registerComponents()
    {
        return [
            'Octcms\Comments\Components\Comments' => 'comments',
        ];
    }

    public function boot()
    {
        if(PluginManager::instance()->hasPlugin('RainLab.Blog')) {
            \RainLab\Blog\Models\Post::extend(function (\RainLab\Blog\Models\Post $model) {
                $model->bindEvent('model.afterFetch', function () use ($model) {
                    $postUrl = Settings::get('post_url_prefix', false) . $model->slug;
                    $model->commentsCount = Comments::where(['url' => $postUrl, 'status' => Comments::STATUS_APPROVED])->count(); //评论数量
                });
                $model->bindEvent('model.beforeSave', function () use ($model) {
                    unset($model->commentsCount);
                });
                $model->bindEvent('model.beforeCreate', function () use ($model) {
                    unset($model->commentsCount);
                });
                $model->bindEvent('model.beforeUpdate', function () use ($model) {
                    unset($model->commentsCount);
                });
            });
        }
    }

    /**
     * @return array
     */
    public function registerSettings()
    {
        return [
            'config' => [
                'label'       => 'octcms.comments::lang.settings.label',
                'icon'        => 'icon-comments-o',
                'description' => 'octcms.comments::lang.settings.description',
                'class'       => 'Octcms\Comments\Models\Settings',
                'order'       => 60
            ]
        ];
    }
}
