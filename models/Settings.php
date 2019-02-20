<?php

namespace Octcms\Comments\Models;

use Model;


/**
 * Class Settings
 * @package Octcms\Comments\Models
 */
class Settings extends Model
{

    /**
     * @var array
     */
    public $implement = ['System.Behaviors.SettingsModel'];

    // A unique code
    /**
     * @var string
     */
    public $settingsCode = 'octcms_comments_settings';

    // Reference to field configuration
    /**
     * @var string
     */
    public $settingsFields = 'fields.yaml';

}
