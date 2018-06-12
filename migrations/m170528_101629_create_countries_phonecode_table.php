<?php

/**
 * @copyright Copyright &copy; Gogodigital Srls
 * @company Gogodigital Srls - Wide ICT Solutions
 * @website http://www.gogodigital.it
 * @github https://github.com/cinghie/yii2-contacts
 * @license GNU GENERAL PUBLIC LICENSE VERSION 3
 * @package yii2-contacts
 * @version 0.9.3
 */

use cinghie\traits\migrations\Migration;

class m170528_101629_create_countries_phonecode_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable( '{{%countries_phonecode}}', [
	        'id'        => $this->primaryKey(11),
	        'iso'       => $this->char(2)->notNull(),
	        'name'      => $this->string(80)->notNull(),
	        'nicename'  => $this->string(80)->notNull(),
	        'iso3'      => $this->char(3)->null()->defaultValue(null),
	        'numcode'   => $this->smallInteger(6)->null()->defaultValue(null),
	        'phonecode' => $this->integer(5)->notNull(),
        ], $this->tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable( '{{%countries_phonecode}}' );
    }

}
