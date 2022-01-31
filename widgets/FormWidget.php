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

namespace cinghie\contacts\widgets;

use cinghie\contacts\models\Forms;
use cinghie\contacts\models\Messages;

/**
 * Class FormWidget
 */
class FormWidget
{
	/**
	 * @var int $id
	 */
	public $id;

	/**
	 * Widget Init
	 */
	public function init()
	{
		parent::init();
	}

	/**
	 * @return string
	 */
	public function run()
	{
		return 'Hello World!';
	}
}
