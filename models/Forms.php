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
use cinghie\traits\ViewsHelpersTrait;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%contacts_forms}}".
 *
 * @property int $id
 * @property int $contact_id
 *
 * @property Contacts $contact
 */
class Forms extends ActiveRecord
{
	use ViewsHelpersTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%contacts_forms}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['contact_id'], 'integer'],
            [['contact_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contacts::class, 'targetAttribute' => ['contact_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('traits', 'ID'),
            'contact_id' => Yii::t('contacts', 'Contact'),
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getContact()
    {
        return $this->hasOne(Contacts::class, ['id' => 'contact_id']);
    }

    /**
     * {@inheritdoc}
     *
     * @return FormsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FormsQuery( static::class );
    }
}
