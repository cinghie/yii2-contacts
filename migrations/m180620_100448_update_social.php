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
 * Class m180620_100448_update_social
 */
class m180620_100448_update_social extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
    	$this->dropColumn('{{%contacts}}','gplus');
	    $this->addColumn('{{%contacts}}', 'pinterest', $this->string(255).' AFTER linkedin');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
	    $this->addColumn('{{%contacts}}', 'gplus', $this->string(255).' AFTER facebook');
	    $this->dropColumn('{{%contacts}}','pinterest');
    }
}
