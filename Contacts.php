<?php

/**
 * @copyright Copyright &copy; Gogodigital Srls
 * @company Gogodigital Srls - Wide ICT Solutions
 * @website http://www.gogodigital.it
 * @github https://github.com/cinghie/yii2-contacts
 * @license GNU GENERAL PUBLIC LICENSE VERSION 3
 * @package yii2-contacts
 * @version 0.9.6
 */

namespace cinghie\contacts;

use Yii;
use yii\base\Module;
use yii\i18n\PhpMessageSource;

class Contacts extends Module
{
    /**
     * @var boolean
     */
    public $showTitles = true;

    /**
     * @inheritdoc
     */
    public function init()
    {
    	$this->registerTranslations();

        parent::init();
    }

    /**
     * Translating module message
     */
    public function registerTranslations()
    {
        if (empty(Yii::$app->i18n->translations['contacts']))
        {
            Yii::$app->i18n->translations['contacts'] = [
                'class' => PhpMessageSource::class,
                'basePath' => __DIR__ . '/messages',
            ];
        }
    }
}
