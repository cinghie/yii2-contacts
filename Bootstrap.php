<?php

/**
 * @copyright Copyright &copy; Gogodigital Srls
 * @company Gogodigital Srls - Wide ICT Solutions
 * @website http://www.gogodigital.it
 * @github https://github.com/cinghie/yii2-contacts
 * @license GNU GENERAL PUBLIC LICENSE VERSION 3
 * @package yii2-contacts
 * @version 0.9.8
 */

namespace cinghie\contacts;

use Yii;
use cinghie\contacts\models\Contacts;
use cinghie\contacts\models\Countriescodes;
use cinghie\contacts\models\Forms;
use cinghie\contacts\models\Messages;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\Module;
use yii\db\ActiveRecord;

/**
 * Class Bootstrap
 */
class Bootstrap implements BootstrapInterface
{
    /**
     * @var array
     */
    private $_modelMap = [
        'Contacts' => Contacts::class,
        'Countriescodes' => Countriescodes::class,
        'Forms' => Forms::class,
        'Messages' => Messages::class,
    ];

	/**
	 * @param Application $app
	 */
    public function bootstrap($app)
    {
        /**
         * @var Module $module
         * @var ActiveRecord $modelName
         */
        if ($app->hasModule('contacts') && ($module = $app->getModule('contacts')) instanceof Module)
        {
            $this->_modelMap = array_merge($this->_modelMap, $module->modelMap);

            foreach ($this->_modelMap as $name => $definition)
            {
                $class = "cinghie\\contacts\\models\\" . $name;

                Yii::$container->set($class, $definition);
                $modelName = is_array($definition) ? $definition['class'] : $definition;
                $module->modelMap[$name] = $modelName;

                if (in_array($name,['Contacts','Countriescodes','Forms','Messages']))
                {
                    Yii::$container->set($name . 'Query', function () use ($modelName) {
                        return $modelName::find();
                    });
                }
            }
        }
    }
}
