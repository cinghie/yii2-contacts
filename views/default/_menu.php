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

use yii\bootstrap\Nav;

echo Nav::widget([
	'options' => [
		'class' => 'nav-tabs',
		'style' => 'margin-bottom: 15px',
	],
	'items' => [
		[
			'label'   => Yii::t('contacts', 'Contacts'),
			'url'     => ['/contacts/contacts/index'],
		],
		[
			'label'   => Yii::t('traits', 'Messages'),
			'url'     => ['/contacts/messages/index'],
		],
		[
			'label'   => Yii::t('traits', 'Forms'),
			'url'     => ['/contacts/forms/index'],
		],
	],
]);
