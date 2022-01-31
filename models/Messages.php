<?php

/**
 * @copyright Copyright &copy; Gogodigital Srls
 * @company Gogodigital Srls - Wide ICT Solutions
 * @website http://www.gogodigital.it
 * @github https://github.com/cinghie/yii2-contacts
 * @license GNU GENERAL PUBLIC LICENSE VERSION 3
 * @package yii2-contacts
 * @version 0.9.8
 */

namespace cinghie\contacts\models;

use Exception;
use Yii;
use cinghie\traits\CreatedTrait;
use cinghie\traits\ViewsHelpersTrait;
use kartik\detail\DetailView;
use yii\base\InvalidParamException;
use yii\db\ActiveRecord;
use yii\helpers\Url;

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
 * @property string $ip
 *
 * @property-read string $fullName
 * @property-read string $messageInformationDetailView
 * @property-read array $createdByDetailView
 * @property-read string $messageDetailView
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
		    [['ip'], 'string', 'max' => 16],
            [['message'], 'string'],
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
	 * Return Contact Full Name
	 *
	 * @return string
	 */
	public function getFullName()
	{
		return $this->lastname . ' ' . $this->firstname;
	}

	/**
	 * Generate DetailView for Messages Informations
	 *
	 * @return string
	 * @throws Exception
	 */
	public function getMessageInformationDetailView()
	{
		return DetailView::widget([
			'model' => $this,
			'condensed' => true,
			'enableEditMode' => false,
			'hover' => true,
			'mode' => DetailView::MODE_VIEW,
			'panel' => [
				'after' => false,
				'before' => false,
				'heading' => Yii::t('contacts', 'Contacts Informations'),
				'type' => DetailView::TYPE_INFO,
			],
			'attributes'=> [
				[
					'columns' => [
						[
							'attribute' => 'name',
							'format' => 'email',
							'valueColOptions' => ['style'=>'width:30%']
						],
						[
							'attribute' => 'email',
							'format' => 'email',
							'valueColOptions' => ['style'=>'width:30%']
						],
					]
				],
				[
					'columns' => [
						[
							'attribute' => 'firstname',
							'valueColOptions' => ['style'=>'width:30%']
						],
						[
							'attribute' => 'lastname',
							'valueColOptions' => ['style'=>'width:30%']
						],
					]
				],
				[
					'columns' => [
						[
							'attribute' => 'phone',
							'format' => 'raw',
							'hAlign' => 'center',
							'valueColOptions' => ['style'=>'width:30%']
						],
						[
							'attribute' => 'mobile',
							'format' => 'raw',
							'hAlign' => 'center',
							'valueColOptions' => ['style'=>'width:30%']
						],
					]
				],
				[
					'columns' => [
						[
							'attribute' => 'created',
							'hAlign' => 'center',
							'valueColOptions' => ['style'=>'width:30%']
						],
						[
							'attribute' => 'created_by',
							'hAlign' => 'center',
							'valueColOptions' => ['style'=>'width:30%']
						],
					]
				]
			]
		]);
	}

	/**
	 * Generate DetailView for Messages
	 *
	 * @return string
	 * @throws Exception
	 */
	public function getMessageDetailView()
	{
		return DetailView::widget([
			'model' => $this,
			'condensed' => true,
			'enableEditMode' => false,
			'hover' => true,
			'mode' => DetailView::MODE_VIEW,
			'panel' => [
				'after' => false,
				'before' => false,
				'heading' => Yii::t('contacts', 'Message Text'),
				'type' => DetailView::TYPE_INFO,
			],
			'attributes'=> [
				[
					'attribute' => 'message',
					'label' => false
				],
			]
		]);
	}

	/**
	 * Generate DetailView for CreatedBy
	 *
	 * @return array
	 * @throws InvalidParamException
	 */
	public function getCreatedByDetailView()
	{
		return [
			'attribute' => 'created_by',
			'format' => 'html',
			'type' => DetailView::INPUT_SWITCH,
			'value' => $this->created_by ? \kartik\helpers\Html::a($this->createdBy->username,urldecode(Url::toRoute(['/user/admin/update', 'id' => $this->createdBy]))) : Yii::t('traits', 'Nobody'),
			'valueColOptions'=> [
				'style'=>'width:30%'
			]
		];
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
