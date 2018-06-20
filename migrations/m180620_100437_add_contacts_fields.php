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
 * Class m180620_100437_add_crm_contacts_fields
 */
class m180620_100437_add_contacts_fields extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
	    $this->addColumn('{{%contacts}}', 'rule', $this->string(255).' AFTER fax_secondary_code');
	    $this->addColumn('{{%contacts}}', 'rule_type', $this->string(255).' AFTER rule');
	    $this->addColumn('{{%contacts}}', 'note', $this->text().' AFTER rule_type');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
	    $this->dropColumn('{{%contacts}}','rule');
	    $this->dropColumn('{{%contacts}}','rule_type');
	    $this->dropColumn('{{%contacts}}','note');
    }

}
