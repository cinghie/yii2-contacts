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

class m180620_100457_create_contacts_messages_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%contacts_messages}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'firstname' => $this->string(100)->notNull(),
            'lastname' => $this->string(100)->notNull(),
            'email' => $this->string(100)->notNull(),
            'phone' => $this->string(26)->notNull(),
            'mobile' => $this->string(26)->notNull(),
            'message' => $this->text()->notNull(),
            'created_by' => $this->integer(11)->defaultValue(null),
            'created' => $this->dateTime()->notNull()->defaultValue('0000-00-00 00:00:00'),
            'ip' => $this->string(16)->notNull(),
        ], $this->tableOptions);

	    // Add Index and Foreign Key
	    $this->createIndex(
		    'index_contacts_messages_created_by',
		    '{{%contacts_messages}}',
		    'created_by'
	    );

	    $this->addForeignKey(
		    'fk_contacts_messages_created_by',
		    '{{%contacts_messages}}', 'created_by',
		    '{{%user}}', 'id',
		    'SET NULL', 'CASCADE'
	    );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
	    $this->dropIndex('index_contacts_messages_created_by', '{{%contacts_messages}}');
        $this->dropTable('{{%contacts_messages}}');
    }
}
