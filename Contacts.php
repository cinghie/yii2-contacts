<?php

/**
 * @copyright Copyright &copy; Gogodigital Srls
 * @company Gogodigital Srls - Wide ICT Solutions
 * @website http://www.gogodigital.it
 * @github https://github.com/cinghie/yii2-contacts
 * @license GNU GENERAL PUBLIC LICENSE VERSION 3
 * @package yii2-contacts
 * @version 0.9.0
 */

namespace cinghie\contacts;

class Contacts extends \yii\base\Module
{

    public $controllerNamespace = 'cinghie\contacts\controllers';

    /**
     * @var boolean Captcha
     */
    public $captcha = true;

    /**
     * @var boolean showTitles in views
     */
    public $showTitles = true;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // Translate
        $this->registerTranslations();
    }

    /**
     * Translating module message
     */
    public function registerTranslations()
    {
        if (empty(\Yii::$app->i18n->translations['contacts']))
        {
            \Yii::$app->i18n->translations['contacts'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => __DIR__ . '/messages',
            ];
        }
    }

}