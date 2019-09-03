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
use cinghie\traits\CreatedTrait;
use cinghie\traits\ViewsHelpersTrait;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%contacts_messages}}".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $mobile
 * @property string $message
 * @property string $created
 * @property string $created_by
 * @property int $ip
 */
class Messages extends ActiveRecord
{
	use CreatedTrait, ViewsHelpersTrait;

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
	    return array_merge(CreatedTrait::rules(), [
            [['name', 'email', 'message'], 'required'],
	        [['name', 'firstname', 'lastname', 'email'], 'string', 'max' => 100],
	        [['phone', 'mobile'], 'string', 'max' => 26],
            [['message'], 'string'],
            [['ip'], 'integer'],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
	    return array_merge(CreatedTrait::attributeLabels(), [
            'id' => Yii::t('traits', 'ID'),
            'name' => Yii::t('traits', 'Fullname'),
            'firstname' => Yii::t('traits', 'Firstname'),
            'lastname' => Yii::t('traits', 'Lastname'),
            'email' => Yii::t('traits', 'Email'),
            'phone' => Yii::t('traits', 'Phone'),
            'mobile' => Yii::t('traits', 'Mobile'),
            'message' => Yii::t('traits', 'Message'),
            'ip' => Yii::t('traits', 'IP'),
        ]);
    }

    /**
     * @inheritdoc
     *
     * @return MessagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MessagesQuery( static::class );
    }
}
