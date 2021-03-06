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
use cinghie\traits\CreatedTrait;
use cinghie\traits\EditorTrait;
use cinghie\traits\ModifiedTrait;
use cinghie\traits\SocialTrait;
use cinghie\traits\StateTrait;
use cinghie\traits\UserTrait;
use cinghie\traits\UserHelpersTrait;
use cinghie\traits\ViewsHelpersTrait;
use kartik\detail\DetailView;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\Html;

/**
 * This is the model class for table "{{%contacts}}".
 *
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $email_secondary
 * @property string $phone
 * @property int $phone_code
 * @property string $phone_secondary
 * @property int $phone_secondary_code
 * @property string $mobile
 * @property int $mobile_code
 * @property string $mobile_secondary
 * @property int $mobile_secondary_code
 * @property string $fax
 * @property int $fax_code
 * @property string $fax_secondary
 * @property int $fax_secondary_code
 * @property string $rule
 * @property string $rule_type
 * @property string $note
 * @property int accept
 * @property int accept_secondary
 * @property string $website
 * @property string $skype
 * @property string $facebook
 * @property string $instagram
 * @property string $linkedin
 * @property string $pinterest
 * @property string $twitter
 * @property string $youtube
 *
 * @property ActiveQuery $vatCodePrefix
 * @property ActiveQuery $faxCode
 * @property ActiveQuery $faxSecondaryCode
 * @property ActiveQuery $mobileCode
 * @property ActiveQuery $mobileSecondaryCode
 * @property ActiveQuery $phoneCode
 * @property ActiveQuery $phoneSecondaryCode
 *
 * @property string $fullName
 * @property string $fullPhone
 * @property string $acceptIcon
 * @property string $accept2Icon
 * @property array $acceptDetailView
 * @property string $contactsSelect2
 * @property string $contactsInformationsDetailView
 * @property string $socialInformationsDetailView
 * @property string $entryInformationsDetailView
 */
class Contacts extends ActiveRecord
{
    use CreatedTrait, EditorTrait, ModifiedTrait, SocialTrait, StateTrait, UserHelpersTrait, UserTrait, ViewsHelpersTrait;

    const EVENT_AFTER_VIEW   = 'afterView';
    const EVENT_AFTER_CREATE = 'afterCreate';
    const EVENT_AFTER_UPDATE = 'afterUpdate';
    const EVENT_AFTER_DELETE = 'afterDelete';
    const EVENT_AFTER_ACTIVE = 'afterActive';
    const EVENT_AFTER_DEACTIVE = 'afterDeactive';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%contacts}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(CreatedTrait::rules(), ModifiedTrait::rules(), SocialTrait::rules(), StateTrait::rules(), UserTrait::rules(), [
            [['firstname', 'lastname'], 'required'],
            [['email', 'email_secondary'], 'email'],
            [['email'], 'unique', 'targetAttribute' => ['email']],
            [['website'], 'url', 'defaultScheme' => 'http'],
            [['phone', 'phone_secondary', 'mobile', 'mobile_secondary', 'fax', 'fax_secondary'], 'string', 'max' => 50],
            [['firstname', 'lastname', 'email', 'email_secondary'], 'string', 'max' => 100],
            [['rule', 'rule_type', 'website', 'skype'], 'string', 'max' => 255],
            [['note'], 'string'],
            [['accept','accept_secondary','phone_code', 'phone_secondary_code', 'mobile_code', 'mobile_secondary_code', 'fax_code', 'fax_secondary_code'], 'integer'],
            //[['fax_code'], 'exist', 'skipOnError' => true, 'targetClass' => Countriescodes::class, 'targetAttribute' => ['fax_code' => 'id']],
            //[['fax_code'], 'required', 'when' => function ($model) { return $model->fax !== ''; }, 'whenClient' => "function (attribute, value) { return $(attribute).val() !== ''; }"],
            //[['fax_secondary_code'], 'exist', 'skipOnError' => true, 'targetClass' => Countriescodes::class, 'targetAttribute' => ['fax_secondary_code' => 'id']],
            //[['fax_secondary_code'], 'required', 'when' => function ($model) { return $model->fax_secondary !== ''; }, 'whenClient' => "function (attribute, value) { return $(attribute).val() !== ''; }"],
            //[['mobile_code'], 'exist', 'skipOnError' => true, 'targetClass' => Countriescodes::class, 'targetAttribute' => ['mobile_code' => 'id']],
            //[['mobile_code'], 'required', 'when' => function ($model) { return $model->mobile !== ''; }, 'whenClient' => "function (attribute, value) { return $(attribute).val() !== ''; }"],
            //[['mobile_secondary_code'], 'exist', 'skipOnError' => true, 'targetClass' => Countriescodes::class, 'targetAttribute' => ['mobile_secondary_code' => 'id']],
            //[['mobile_secondary_code'], 'required', 'when' => function ($model) { return $model->mobile_secondary !== ''; }, 'whenClient' => "function (attribute, value) { return $(attribute).val() !== ''; }"],
            //[['phone_code'], 'exist', 'skipOnError' => true, 'targetClass' => Countriescodes::class, 'targetAttribute' => ['phone_code' => 'id']],
            //[['phone_code'], 'required', 'when' => function ($model) { return $model->phone !== ''; }, 'whenClient' => "function (attribute, value) { return $(attribute).val() !== ''; }"],
            //[['phone_secondary_code'], 'exist', 'skipOnError' => true, 'targetClass' => Countriescodes::class, 'targetAttribute' => ['phone_secondary_code' => 'id']],
            //[['phone_secondary_code'], 'required', 'when' => function ($model) { return $model->phone_secondary !== ''; }, 'whenClient' => "function (attribute, value) { return $(attribute).val() !== ''; }"],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(CreatedTrait::attributeLabels(), ModifiedTrait::attributeLabels(), SocialTrait::attributeLabels(), StateTrait::attributeLabels(), UserTrait::attributeLabels(), [
            'id' => Yii::t('traits', 'ID'),
            'firstname' => Yii::t('traits', 'Firstname'),
            'lastname' => Yii::t('traits', 'Lastname'),
            'email' => Yii::t('traits', 'Email'),
            'email_secondary' => Yii::t('traits', 'Email Secondary'),
            'phone' => Yii::t('traits', 'Phone'),
            'phone_code' => Yii::t('traits', 'Phone Code'),
            'phone_secondary' => Yii::t('traits', 'Phone Secondary'),
            'phone_secondary_code' => Yii::t('traits', 'Phone Secondary Code'),
            'mobile' => Yii::t('traits', 'Mobile'),
            'mobile_code' => Yii::t('traits', 'Mobile Code'),
            'mobile_secondary' => Yii::t('traits', 'Mobile Secondary'),
            'mobile_secondary_code' => Yii::t('traits', 'Mobile Secondary Code'),
            'fax' => Yii::t('traits', 'Fax'),
            'fax_code' => Yii::t('traits', 'Fax Code'),
            'fax_secondary' => Yii::t('traits', 'Fax Secondary'),
            'fax_secondary_code' => Yii::t('traits', 'Fax Secondary Code'),
            'accept' => Yii::t('traits', 'Accept'),
            'accept_secondary' => Yii::t('contacts', 'Accept Secondary'),
            'rule' => Yii::t('traits', 'Rule'),
            'rule_type' => Yii::t('traits', 'Rule Type'),
            'note' => Yii::t('traits', 'Note'),
            'website' => Yii::t('traits', 'Website'),
            'skype' => Yii::t('traits', 'Skype'),
        ]);
    }

    /**
     * @return ActiveQuery
     */
    public function getVatCodePrefix()
    {
        return $this->hasOne(Countriescodes::class, ['id' => 'vat_code_prefix']);
    }

    /**
     * @return ActiveQuery
     */
    public function getPhoneCode()
    {
        return $this->hasOne(Countriescodes::class, ['id' => 'phone_code']);
    }

    /**
     * @return ActiveQuery
     */
    public function getPhoneSecondaryCode()
    {
        return $this->hasOne(Countriescodes::class, ['id' => 'phone_secondary_code']);
    }

    /**
     * @return ActiveQuery
     */
    public function getMobileCode()
    {
        return $this->hasOne(Countriescodes::class, ['id' => 'mobile_code']);
    }

    /**
     * @return ActiveQuery
     */
    public function getMobileSecondaryCode()
    {
        return $this->hasOne(Countriescodes::class, ['id' => 'mobile_secondary_code']);
    }

    /**
     * @return ActiveQuery
     */
    public function getFaxCode()
    {
        return $this->hasOne(Countriescodes::class, ['id' => 'fax_code']);
    }

    /**
     * @return ActiveQuery
     */
    public function getFaxSecondaryCode()
    {
        return $this->hasOne(Countriescodes::class, ['id' => 'fax_secondary_code']);
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
	 * Get Phone field with code
	 *
	 * @param string $field
	 *
	 * @return string
	 */
    public function getFullPhone($field = 'phone')
    {
    	$fieldcode = $field.'Code';
	    $fieldcode = str_replace(['phone_secondary','mobile_secondary','fax_secondary'],['phoneSecondary','mobileSecondary','faxSecondary'],$fieldcode);

	    if($this->$field && $this->$fieldcode) {
		    return '+' .$this->$fieldcode->phonecode. ' ' .$this->$field;
	    }

	    if($this->$field && !$this->$fieldcode) {
		    return $this->$field;
	    }

	    return '';
    }

	/**
	 * Get Icon for Accept field
	 *
	 * @return string
	 */
    public function getAcceptIcon()
    {
    	return $this->accept ? '<span class="label label-success">' . Yii::t('traits', 'Yes') . '</span>' : '<span class="label label-danger">' . Yii::t('traits', 'No') . '</span>';
    }

	/**
	 * Get Icon for Accept field
	 *
	 * @return string
	 */
	public function getAccept2Icon()
	{
		return $this->accept_secondary ? '<span class="label label-success">' . Yii::t('traits', 'Yes') . '</span>' : '<span class="label label-danger">' . Yii::t('traits', 'No') . '</span>';
	}

	/**
	 * Get Contacts Select2
	 *
	 * @param ActiveForm $form
	 * @param string $attribute
	 *
	 * @return string
	 * @throws Exception
	 */
	public function getContactsWidget($form, $attribute = 'contact_id')
	{
		return $form->field($this, $attribute)->widget(Select2::class, [
			'data' => $this->getContactsSelect2(),
			'addon' => [
				'prepend' => [
					'content'=>'<i class="fa fa-address-book"></i>'
				]
			],
		]);
	}

	/**
	 * Get Contacts Select2
	 *
	 * @return array
	 */
	public function getContactsSelect2()
	{
		$contacts = self::find()
			->select(['id','firstname','lastname'])
			->where(['state' => 1])
		    ->all();

		$array = [];

		foreach($contacts as $contact) {
			$array[$contact['id']] = ucwords($contact['lastname']).' '.ucwords($contact['firstname']);
		}

		return $array;
	}

	/**
	 * Generate DetailView for Contacts Informations
	 *
	 * @return string
	 * @throws Exception
	 */
	public function getContactsInformationsDetailView()
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
							'attribute' => 'firstname',
							'valueColOptions' => ['style'=>'width:30%']
						],
						[
							'attribute' => 'lastname',
							'valueColOptions' => ['style'=>'width:30%']
						]
					]
				],
				[
					'columns' => [
						[
							'attribute' => 'rule',
							'valueColOptions' => ['style'=>'width:30%']
						],
						[
							'attribute' => 'rule_type',
							'valueColOptions' => ['style'=>'width:30%']
						]
					]
				],
				[
					'columns' => [
						[
							'attribute' => 'email',
							'format' => 'email',
							'valueColOptions' => ['style'=>'width:30%']
						],
						[
							'attribute' => 'email_secondary',
							'format' => 'email',
							'valueColOptions' => ['style'=>'width:30%']
						]
					]
				],
				[
					'columns' => [
						[
							'attribute' => 'accept',
							'format' => 'raw',
							'value' => $this->accept ? '<span class="label label-success">'. Yii::t('traits', 'Yes').'</span>' : '<span class="label label-danger">'. Yii::t('traits', 'No').'</span>',
							'type' => DetailView::INPUT_SWITCH,
							'widgetOptions' => [
								'pluginOptions' => [
									'onText' => 'Yes',
									'offText' => 'No',
								]
							],
							'valueColOptions' => ['style'=>'width:30%']
						],
						[
							'attribute' => 'accept_secondary',
							'format' => 'raw',
							'value' => $this->accept_secondary ? '<span class="label label-success">'. Yii::t('traits', 'Yes').'</span>' : '<span class="label label-danger">'. Yii::t('traits', 'No').'</span>',
							'type' => DetailView::INPUT_SWITCH,
							'widgetOptions' => [
								'pluginOptions' => [
									'onText' => 'Yes',
									'offText' => 'No',
								]
							],
							'valueColOptions' => ['style'=>'width:30%']
						]
					]
				],
				[
					'columns' => [
						[
							'attribute' => 'phone',
							'format' => 'raw',
							'hAlign' => 'center',
							'value' => $this->getFullPhone(),
							'valueColOptions' => ['style'=>'width:30%']
						],
						[
							'attribute' => 'phone_secondary',
							'format' => 'raw',
							'hAlign' => 'center',
							'value' => $this->getFullPhone('phone_secondary'),
							'valueColOptions' => ['style'=>'width:30%']
						]
					]
				],
				[
					'columns' => [
						[
							'attribute' => 'mobile',
							'format' => 'raw',
							'hAlign' => 'center',
							'value' => $this->getFullPhone('mobile'),
							'valueColOptions' => ['style'=>'width:30%']
						],
						[
							'attribute' => 'mobile_secondary',
							'format' => 'raw',
							'hAlign' => 'center',
							'value' => $this->getFullPhone('mobile_secondary'),
							'valueColOptions' => ['style'=>'width:30%']
						]
					],
				],
				[
					'columns' => [
						[
							'attribute' => 'fax',
							'format' => 'raw',
							'hAlign' => 'center',
							'value' => $this->getFullPhone('fax'),
							'valueColOptions' => ['style'=>'width:30%']
						],
						[
							'attribute' => 'fax_secondary',
							'format' => 'raw',
							'hAlign' => 'center',
							'value' => $this->getFullPhone('fax_secondary'),
							'valueColOptions' => ['style'=>'width:30%']
						]
					],
				],
				[
					'columns' => [
						[
							'attribute' => 'website',
							'format' => 'raw',
							'hAlign' => 'center',
							'value' => Html::a($this->website, $this->website, ['target' => 'blank'])
						]
					],
				],
				[
					'columns' => [
						[
							'attribute' => 'note',
							'format' => 'raw',
							'hAlign' => 'center',
							'value' => Html::encode($this->note)
						]
					]
				]
			]
		]);
	}

	/**
	 * Generate DetailView for Social Informations
	 *
	 * @return string
	 * @throws Exception
	 */
	public function getSocialInformationsDetailView()
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
				'heading' => Yii::t('contacts', 'Social Informations'),
				'type' => DetailView::TYPE_INFO,
			],
			'deleteOptions' => false,
			'attributes' => [
				[
					'attribute' => 'skype',
					'format' => 'raw',
					'hAlign' => 'center',
					'value' => Html::a($this->skype, 'skype:cinghie?add')
				],
				[
					'attribute' => 'facebook',
					'format' => 'raw',
					'hAlign' => 'center',
					'value' => Html::a($this->facebook, $this->facebook, ['target' => 'blank'])
				],
				[
					'attribute' => 'instagram',
					'format' => 'raw',
					'hAlign' => 'center',
					'value' => Html::a($this->instagram, $this->instagram, ['target' => 'blank'])
				],
				[
					'attribute' => 'linkedin',
					'format' => 'raw',
					'hAlign' => 'center',
					'value' => Html::a($this->linkedin, $this->linkedin, ['target' => 'blank'])
				],
				[
					'attribute' => 'pinterest',
					'format' => 'raw',
					'hAlign' => 'center',
					'value' => Html::a($this->pinterest, $this->pinterest, ['target' => 'blank'])
				],
				[
					'attribute' => 'twitter',
					'format' => 'raw',
					'hAlign' => 'center',
					'value' => Html::a($this->twitter, $this->twitter, ['target' => 'blank'])
				],
				[
					'attribute' => 'youtube',
					'format' => 'raw',
					'hAlign' => 'center',
					'value' => Html::a($this->youtube, $this->youtube, ['target' => 'blank'])
				]
			]
		]);
	}

	/**
	 * Generate DetailView for Entry Informations
	 *
	 * @return string
	 * @throws Exception
	 */
	public function getEntryInformationsDetailView()
	{
		return DetailView::widget([
			'model' => $this,
			'enableEditMode' => false,
			'deleteOptions' => false,
			'condensed' => true,
			'hover' => true,
			'mode' => DetailView::MODE_VIEW,
			'panel' => [
				'after' => false,
				'before' => false,
				'heading' => Yii::t('traits', 'Entry Informations'),
				'type' => DetailView::TYPE_INFO,
			],
			'attributes' => [
				$this->getStateDetailView(),
				$this->getUserDetailView(),
				$this->getCreatedByDetailView(),
				$this->getCreatedDetailView(),
				$this->getModifiedByDetailView(),
				$this->getModifiedDetailView(),
			]
		]);
	}

	/**
	 * Generate DetailView for State
	 *
	 * @return array
	 */
	public function getAcceptDetailView()
	{
		return [
			'attribute'       => 'accept',
			'format'          => 'html',
			'type'            => DetailView::INPUT_SWITCH,
			'value'           => $this->getAcceptIcon(),
			'valueColOptions' => [
				'style' => 'width:30%'
			],
			'widgetOptions'   => [
				'pluginOptions' => [
					'onText'  => 'Yes',
					'offText' => 'No',
				]
			]
		];
	}

    /**
     * @inheritdoc
     *
     * @return ContactsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ContactsQuery( static::class );
    }
}
