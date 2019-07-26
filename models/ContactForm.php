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

namespace cinghie\contacts\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%contacts_messages}}".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $message
 * @property int $ip
 */
class ContactForm extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%contacts_messages}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'message', 'ip'], 'required'],
            [['message'], 'string'],
            [['ip'], 'integer'],
            [['name', 'email'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('traits', 'ID'),
            'name' => Yii::t('traits', 'Name'),
            'email' => Yii::t('traits', 'Email'),
            'message' => Yii::t('traits', 'Message'),
            'ip' => Yii::t('traits', 'Ip'),
        ];
    }

    /**
     * @inheritdoc
     *
     * @return ContactFormQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ContactFormQuery( static::class );
    }
}
