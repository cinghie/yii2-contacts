<?php

use yii\db\Migration;

/**
 * Handles the creation of table `countries_phonecode`.
 */
class m170528_101629_create_countries_phonecode_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%countries_phonecode}}', [
            'id'=> $this->primaryKey(11),
            'iso'=> $this->char(2)->notNull(),
            'name'=> $this->string(80)->notNull(),
            'nicename'=> $this->string(80)->notNull(),
            'iso3'=> $this->char(3)->null()->defaultValue(null),
            'numcode'=> $this->smallInteger(6)->null()->defaultValue(null),
            'phonecode'=> $this->integer(5)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%countries_phonecode}}');
    }

}
