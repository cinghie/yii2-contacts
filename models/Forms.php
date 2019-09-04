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

use Exception;
use Yii;
use cinghie\traits\TitleAliasTrait;
use cinghie\traits\ViewsHelpersTrait;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%contacts_forms}}".
 *
 * @property int $id
 * @property int $contact_id
 * @property string $title
 * @property string $alias
 * @property int $captcha
 *
 * @property Contacts $contact
 */
class Forms extends ActiveRecord
{
	use TitleAliasTrait, ViewsHelpersTrait;

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
	        [['title','alias','contact_id'], 'string', 'max' => 64],
	        [['alias'], 'unique'],
	        [['contact_id','captcha'], 'integer'],
            [['contact_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contacts::class, 'targetAttribute' => ['contact_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
	    return array_merge(TitleAliasTrait::attributeLabels(),[
            'id' => Yii::t('traits', 'ID'),
            'contact_id' => Yii::t('contacts', 'Contact'),
            'captcha' => Yii::t('traits', 'Captcha'),
        ]);
    }

    /**
     * @return ActiveQuery
     */
    public function getContact()
    {
        return $this->hasOne(Contacts::class, ['id' => 'contact_id']);
    }

	/**
	 * Get Contacts Select2
	 *
	 * @param ActiveForm $form
	 *
	 * @return string
	 * @throws Exception
	 */
	public function getContactsWidget($form)
	{
		$contacts = new Contacts();

		return $form->field($this, 'contact_id')->widget(Select2::class, [
			'data' => $contacts->getContactsSelect2(),
			'addon' => [
				'prepend' => [
					'content'=>'<i class="fa fa-address-book"></i>'
				]
			],
		]);
	}

	/**
	 * Get Icon for Accept field
	 *
	 * @return string
	 */
	public function getCaptchaIcon()
	{
		return $this->captcha ? '<span class="label label-success">' . Yii::t('traits', 'Yes') . '</span>' : '<span class="label label-danger">' . Yii::t('traits', 'No') . '</span>';
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
