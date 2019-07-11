<?php

/**
 * @copyright Copyright &copy; Gogodigital Srls
 * @company Gogodigital Srls - Wide ICT Solutions
 * @website http://www.gogodigital.it
 * @package yii2-crm
 * @version 0.2.5
 */

use cinghie\traits\migrations\Migration;

/**
 * Class m180620_100447_add_accept2_field
 */
class m180620_100447_add_accept2_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
	    $this->addColumn('{{%contacts}}', 'accept_secondary', $this->boolean()->notNull()->defaultValue(1).' AFTER accept');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
	    $this->dropColumn('{{%contacts}}','accept_secondary');
    }
}
