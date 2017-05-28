<?php

use yii\db\Migration;

/**
 * Handles the creation of table `news`.
 */
class m170528_101639_create_contacts_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%contacts}}', [
            'id' => $this->primaryKey(),
            'userid' => $this->integer(11)->defaultValue(null),
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
            'state' => $this->boolean()->notNull()->defaultValue(1),
            'created_by' => $this->integer(11)->defaultValue(null),
            'created' => $this->dateTime()->notNull()->defaultValue('0000-00-00 00:00:00'),
            'modified_by' => $this->integer(11)->defaultValue(null),
            'modified' => $this->dateTime()->notNull()->defaultValue('0000-00-00 00:00:00'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%contacts}}');
    }
}
