<?php

use yii\db\Migration;

/**
 * Handles the creation of table `news`.
 */
class m170528_101649_create_address_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%address}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%address}}');
    }
}
