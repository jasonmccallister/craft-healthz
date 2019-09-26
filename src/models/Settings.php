<?php
/**
 * Health Check plugin for Craft CMS 3.x
 *
 * Add health checks to your Craft website, useful when running inside of Docker
 *
 * @link      https://mccallister.io
 * @copyright Copyright (c) 2019 Jason McCallister
 */

namespace mccallister\healthz\models;

use craft\base\Model;

/**
 * Healthz Settings Model
 *
 * This is a model used to define the plugin's settings.
 *
 * Models are containers for data. Just about every time information is passed
 * between services, controllers, and templates in Craft, it’s passed via a model.
 *
 * https://craftcms.com/docs/plugins/models
 *
 * @author    Jason McCallister
 * @package   Healthz
 * @since     1.0.0
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * Ping database setting attribute
     *
     * @var bool
     */
    public $pingDatabase = 'Ping Database';

    // Public Methods
    // =========================================================================

    /**
     * Returns the validation rules for attributes.
     *
     * Validation rules are used by [[validate()]] to check if attribute values are valid.
     * Child classes may override this method to declare different validation rules.
     *
     * More info: http://www.yiiframework.com/doc-2.0/guide-input-validation.html
     *
     * @return array
     */
    public function rules()
    {
        return [
            ['pingDatabase', 'boolean'],
            ['pingDatabase', 'default', 'value' => true],
        ];
    }
}
