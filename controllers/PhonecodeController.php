<?php

/**
 * @copyright Copyright &copy; Gogodigital Srls
 * @company Gogodigital Srls - Wide ICT Solutions
 * @website http://www.gogodigital.it
 * @github https://github.com/cinghie/yii2-contacts
 * @license GNU GENERAL PUBLIC LICENSE VERSION 3
 * @package yii2-contacts
 * @version 0.9.7
 */

namespace cinghie\contacts\controllers;

use RuntimeException;
use Yii;
use yii\db\Exception;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

class PhonecodeController extends Controller
{
	/**
	 * @inheritDoc
	 */
	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['countries','prefix'],
                        'roles' => ['@']
                    ],
                ],
                'denyCallback' => static function () {
	                throw new RuntimeException(Yii::t('traits','You are not allowed to access this page'));
                }
            ],
        ];
    }

	/**
	 * Renders Countries Phone Prefix
	 *
	 * @param null $q
	 * @param null $id
	 *
	 * @return array
	 * @throws Exception
	 */
    public function actionPrefix($q = null, $id = null)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $out = ['results' => ['name' => '', 'phonecode' => '']];
        $query = new Query;

        if ( null !== $q ) {

            $query->select('id, nicename AS text')
                ->from('{{%countries_phonecode}}')
                ->where(['like', 'nicename', $q]);

        } elseif ($id > 0) {

            $query->select('id, nicename AS text')
                ->from('{{%countries_phonecode}}')
                ->where(['=', 'nicename', $id]);

        } else {

            $query->select('id, nicename AS text')
                ->from('{{%countries_phonecode}}');

        }

        $command = $query->createCommand();
        $data = $command->queryAll();

        $out['results'] = array_values($data);

        return $out;
    }

	/**
	 * Renders Countries Code
	 *
	 * @param string $q
	 * @param int $id
	 *
	 * @return array
	 * @throws Exception
	 */
    public function actionCountries($q = null, $id = null)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $out = ['results' => ['iso' => '', 'nicename' => '']];
        $query = new Query;

        if ( null !== $q ) {

            $query->select('id, iso AS text')
                ->from('{{%countries_phonecode}}')
                ->where(['like', 'nicename', $q]);

        } elseif ($id > 0) {

            $query->select('id, iso AS text')
                ->from('{{%countries_phonecode}}')
                ->where(['=', 'iso', $id]);

        } else {

            $query->select('id, iso AS text')
                ->from('{{%countries_phonecode}}');

        }

        $command = $query->createCommand();
        $data = $command->queryAll();

        $out['results'] = array_values($data);

        return $out;
    }
}
