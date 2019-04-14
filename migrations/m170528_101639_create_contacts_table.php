<?php

/**
 * @copyright Copyright &copy; Gogodigital Srls
 * @company Gogodigital Srls - Wide ICT Solutions
 * @website http://www.gogodigital.it
 * @github https://github.com/cinghie/yii2-contacts
 * @license GNU GENERAL PUBLIC LICENSE VERSION 3
 * @package yii2-contacts
 * @version 0.9.6
 */

use cinghie\traits\migrations\Migration;

class m170528_101639_create_contacts_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%contacts}}', [
            'id' => $this->primaryKey(),
            'firstname' => $this->string(100)->notNull(),
            'lastname' => $this->string(100)->notNull(),
            'email' => $this->string(100),
            'email_secondary' => $this->string(100),
            'phone' => $this->string(50),
            'phone_code' => $this->integer(11)->defaultValue(null),
            'phone_secondary' => $this->string(50),
            'phone_secondary_code' => $this->integer(11)->defaultValue(null),
            'mobile' => $this->string(50),
            'mobile_code' => $this->integer(11)->defaultValue(null),
            'mobile_secondary' => $this->string(50),
            'mobile_secondary_code' => $this->integer(11)->defaultValue(null),
            'fax' => $this->string(50),
            'fax_code' => $this->integer(11)->defaultValue(null),
            'fax_secondary' => $this->string(50),
            'fax_secondary_code' => $this->integer(11)->defaultValue(null),
            'website' => $this->string(255),
            'skype' => $this->string(255),
            'facebook' => $this->string(255),
            'gplus' => $this->string(255),
            'instagram' => $this->string(255),
            'linkedin' => $this->string(255),
            'twitter' => $this->string(255),
            'youtube' => $this->string(255),
            'accept' => $this->boolean()->notNull()->defaultValue(1),
            'state' => $this->boolean()->notNull()->defaultValue(1),
            'user_id' => $this->integer(11)->defaultValue(null),
            'created_by' => $this->integer(11)->defaultValue(null),
            'created' => $this->dateTime()->notNull()->defaultValue('0000-00-00 00:00:00'),
            'modified_by' => $this->integer(11)->defaultValue(null),
            'modified' => $this->dateTime()->notNull()->defaultValue('0000-00-00 00:00:00'),
        ], $this->tableOptions);

        // Add Index and Foreign Key
        $this->createIndex(
            'index_contacts_phone_code',
            '{{%contacts}}',
            'phone_code'
        );

        $this->addForeignKey(
            'fk_contacts_phone_code',
            '{{%contacts}}', 'phone_code',
            '{{%countries_phonecode}}', 'id',
            'SET NULL', 'CASCADE'
        );

        // Add Index and Foreign Key
        $this->createIndex(
            'index_contacts_phone_secondary_code',
            '{{%contacts}}',
            'phone_secondary_code'
        );

        $this->addForeignKey(
            'fk_contacts_phone_secondary_code',
            '{{%contacts}}', 'phone_secondary_code',
            '{{%countries_phonecode}}', 'id',
            'SET NULL', 'CASCADE'
        );

        // Add Index and Foreign Key
        $this->createIndex(
            'index_contacts_mobile_code',
            '{{%contacts}}',
            'mobile_code'
        );

        $this->addForeignKey(
            'fk_contacts_mobile_code',
            '{{%contacts}}', 'mobile_code',
            '{{%countries_phonecode}}', 'id',
            'SET NULL', 'CASCADE'
        );

        // Add Index and Foreign Key
        $this->createIndex(
            'index_contacts_mobile_secondary_code',
            '{{%contacts}}',
            'mobile_secondary_code'
        );

        $this->addForeignKey(
            'fk_contacts_mobile_secondary_code',
            '{{%contacts}}', 'mobile_secondary_code',
            '{{%countries_phonecode}}', 'id',
            'SET NULL', 'CASCADE'
        );

        // Add Index and Foreign Key
        $this->createIndex(
            'index_contacts_fax_code',
            '{{%contacts}}', 'fax_code'
        );

        $this->addForeignKey(
            'fk_contacts_fax_code',
            '{{%contacts}}', 'fax_code',
            '{{%countries_phonecode}}', 'id',
            'SET NULL', 'CASCADE'
        );

        // Add Index and Foreign Key
        $this->createIndex(
            'index_contacts_fax_secondary_code',
            '{{%contacts}}',
            'fax_secondary_code'
        );

        $this->addForeignKey(
            'fk_contacts_fax_secondary_code',
            '{{%contacts}}', 'fax_secondary_code',
            '{{%countries_phonecode}}', 'id',
            'SET NULL', 'CASCADE'
        );

        // Add Index and Foreign Key user_id
        $this->createIndex(
            'index_contacts_user_id',
            '{{%contacts}}',
            'user_id'
        );

        $this->addForeignKey(
            'fk_contacts_user_id',
            '{{%contacts}}', 'user_id',
            '{{%user}}', 'id',
            'SET NULL', 'CASCADE'
        );

        // Add Index and Foreign Key
        $this->createIndex(
            'index_contacts_created_by',
            '{{%contacts}}',
            'created_by'
        );

        $this->addForeignKey(
            'fk_contacts_created_by',
            '{{%contacts}}', 'created_by',
            '{{%user}}', 'id',
            'SET NULL', 'CASCADE'
        );

        // Add Index and Foreign Key
        $this->createIndex(
            'index_contacts_modified_by',
            '{{%contacts}}',
            'modified_by'
        );

        $this->addForeignKey(
            'fk_contacts_modified_by',
            '{{%contacts}}', 'modified_by',
            '{{%user}}', 'id',
            'SET NULL', 'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_contacts_phone_code', '{{%contacts}}');
        $this->dropForeignKey('fk_contacts_phone_secondary_code', '{{%contacts}}');
        $this->dropForeignKey('fk_contacts_mobile_code', '{{%contacts}}');
        $this->dropForeignKey('fk_contacts_mobile_secondary_code', '{{%contacts}}');
        $this->dropForeignKey('fk_contacts_fax_code', '{{%contacts}}');
        $this->dropForeignKey('fk_contacts_fax_secondary_code', '{{%contacts}}');
        $this->dropForeignKey('fk_contacts_user_id', '{{%contacts}}');
        $this->dropForeignKey('fk_contacts_created_by', '{{%contacts}}');
        $this->dropForeignKey('fk_contacts_modified_by', '{{%contacts}}');
        $this->dropIndex('index_contacts_phone_code', '{{%contacts}}');
        $this->dropIndex('index_contacts_phone_secondary_code', '{{%contacts}}');
        $this->dropIndex('index_contacts_mobile_code', '{{%contacts}}');
        $this->dropIndex('index_contacts_mobile_secondary_code', '{{%contacts}}');
        $this->dropIndex('index_contacts_fax_code', '{{%contacts}}');
        $this->dropIndex('index_contacts_fax_secondary_code', '{{%contacts}}');
        $this->dropIndex('index_contacts_user_id', '{{%contacts}}');
        $this->dropIndex('index_contacts_created_by', '{{%contacts}}');
        $this->dropIndex('index_contacts_modified_by', '{{%contacts}}');
        $this->dropTable('{{%contacts}}');
    }
}
