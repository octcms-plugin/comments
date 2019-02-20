<?php

namespace Octcms\Comments\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Request;
use SaurabhDhariwal\Comments\Models\Comments as CommentsModel;

/**
 * Class Comments
 * @package Octcms\Comments\Components
 */
class Comments extends ComponentBase
{
    public static $allowedSortingOptions = [
        'id asc'         => 'octcms.comments::lang.sorting.id_asc',
        'id desc'        => 'octcms.comments::lang.sorting.id_desc',
        'created_at asc '   => 'octcms.comments::lang.sorting.created_asc',
        'created_at desc'   => 'octcms.comments::lang.sorting.created_desc',
        'random'            => 'octcms.comments::lang.sorting.random'
    ];

    public $url;

    public $commentPosts;

    /**
     * @return array
     */
    public function init()
    {
        parent::init();
        $this->url = mb_strtolower(Request::path());
    }

    public function componentDetails()
    {
        return [
            'name' => 'octcms.comments::lang.components.name',
            'description' => 'octcms.comments::lang.components.description'
        ];
    }

    /**
     * @return array
     */
    public function defineProperties()
    {
        return [
            'urlFilter' => [
                'title'             => 'octcms.comments::lang.components.url_filter_title',
                'description'       => 'octcms.comments::lang.components.url_filter_description',
                'default'           => '',
                'type'              => 'string'
            ],

            'limit' => [
                'title'             => 'octcms.comments::lang.components.limit_title',
                'description'       => 'octcms.comments::lang.components.limit_description',
                'type'              => 'string',
                'default'           => '0',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'octcms.comments::lang.components.limit_validation_message',
                'showExternalParam' => false
            ],

            'sortOrder' => [
                'title'       => 'octcms.comments::lang.components.order_title',
                'description' => 'octcms.comments::lang.components.order_description',
                'type'        => 'dropdown',
                'default'     => 'id desc',
                'showExternalParam' => false
            ],
        ];
    }

    public function getOrderByOptions()
    {
        $options = self::$allowedSortingOptions;

        foreach ($options as $key => $value) {
            $options[$key] = Lang::get($value);
        }

        return $options;
    }

    /**
     *
     */
    public function onRun()
    {
        $this->commentPosts = $this->page['commentPosts'] = $this->listPosts();
    }

    /**
     * @return array
     */
    protected function listPosts()
    {
        $urlFilter = $this->property('urlFilter');
        $limit = (int)$this->property('limit');
        $sortOrder = $this->property('sortOrder');
        $where = ['status' => CommentsModel::STATUS_APPROVED];
        if(!empty($urlFilter)) {
            $where['url'] = $urlFilter;
        }
        $comments = CommentsModel::where($where);
        if($sortOrder == 'random'){
            $comments = $comments->inRandomOrder();
        } else {
            @list($sortField, $sortDirection) = explode(' ', $sortOrder);

            if (is_null($sortDirection)) {
                $sortDirection = "desc";
            }
            $comments = $comments->orderBy($sortField, $sortDirection);
        }
        if($limit > 0) {
            $comments = $comments->limit($limit);
        }
        $comments = $comments->get();
        return $comments;
    }

}
