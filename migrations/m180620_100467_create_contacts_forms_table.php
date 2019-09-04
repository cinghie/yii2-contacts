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

use cinghie\traits\migrations\Migration;

class m180620_100467_create_contacts_forms_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%contacts_forms}}', [
            'id' => $this->primaryKey(),
            'contact_id' => $this->integer(11)->defaultValue(null),
            'title' => $this->string(64)->notNull(),
            'alias' => $this->string(64)->notNull(),
            'captcha' => $this->boolean()->notNull()->defaultValue(1),
        ], $this->tableOptions);

	    // Add Index and Foreign Key contact_id
	    $this->createIndex(
		    'index_contacts_forms_contact_id',
		    '{{%contacts_forms}}',
		    'contact_id'
	    );
	    $this->addForeignKey(
		    'fk_contacts_forms_contact_id',
		    '{{%contacts_forms}}', 'contact_id',
		    '{{%contacts}}', 'id'
	    );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
	    $this->dropForeignKey('fk_contacts_forms_contact_id', '{{%contacts_forms}}');
	    $this->dropIndex('index_contacts_forms_contact_id', '{{%contacts_forms}}');
        $this->dropTable('{{%contacts_forms}}');
    }
}
