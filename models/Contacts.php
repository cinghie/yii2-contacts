<?php

/**
 * @copyright Copyright &copy; Gogodigital Srls
 * @company Gogodigital Srls - Wide ICT Solutions
 * @website http://www.gogodigital.it
 * @github https://github.com/cinghie/yii2-contacts
 * @license GNU GENERAL PUBLIC LICENSE VERSION 3
 * @package yii2-contacts
 * @version 0.9.4
 */

namespace cinghie\contacts\models;

use Yii;
use cinghie\traits\CreatedTrait;
use cinghie\traits\EditorTrait;
use cinghie\traits\ModifiedTrait;
use cinghie\traits\StateTrait;
use cinghie\traits\UserTrait;
use cinghie\traits\UserHelpersTrait;
use cinghie\traits\ViewsHelpersTrait;
use kartik\detail\DetailView;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

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
 * @property string $website
 * @property string $skype
 * @property string $facebook
 * @property string $gplus
 * @property string $instagram
 * @property string $linkedin
 * @property string $twitter
 * @property string $youtube
 *
 * @property ActiveQuery $vatCodePrefix
 * @property Countriescodes $faxCode
 * @property Countriescodes $faxSecondaryCode
 * @property Countriescodes $mobileCode
 * @property Countriescodes $mobileSecondaryCode
 * @property Countriescodes $phoneCode
 * @property Countriescodes $phoneSecondaryCode
 *
 * @property string $fullName
 * @property array $publishSelect2
 * @property array $acceptDetailView
 * @property string $entryInformationsDetailView
 */
class Contacts extends ActiveRecord
{
    
    use CreatedTrait, EditorTrait, ModifiedTrait, StateTrait, UserHelpersTrait, UserTrait, ViewsHelpersTrait;

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
        return array_merge(CreatedTrait::rules(), ModifiedTrait::rules(), StateTrait::rules(), UserTrait::rules(), [
            [['firstname', 'lastname'], 'required'],
            [['email', 'email_secondary'], 'email'],
            [['email'], 'unique', 'targetAttribute' => ['email']],
            [['website'], 'url', 'defaultScheme' => 'http'],
            [['phone', 'phone_secondary', 'mobile', 'mobile_secondary', 'fax', 'fax_secondary'], 'string', 'max' => 50],
            [['firstname', 'lastname', 'email', 'email_secondary'], 'string', 'max' => 100],
            [['rule', 'rule_type', 'website', 'skype', 'facebook', 'gplus', 'instagram', 'linkedin', 'twitter', 'youtube'], 'string', 'max' => 255],
            [['note'], 'string'],
            [['accept','phone_code', 'phone_secondary_code', 'mobile_code', 'mobile_secondary_code', 'fax_code', 'fax_secondary_code'], 'integer'],
            [['fax_code'], 'exist', 'skipOnError' => true, 'targetClass' => Countriescodes::class, 'targetAttribute' => ['fax_code' => 'id']],
            [['fax_code'], 'required', 'when' => function ($model) { return $model->fax !== ''; }, 'whenClient' => "function (attribute, value) { return $(attribute).val() !== ''; }"],
            [['fax_secondary_code'], 'exist', 'skipOnError' => true, 'targetClass' => Countriescodes::class, 'targetAttribute' => ['fax_secondary_code' => 'id']],
            [['fax_secondary_code'], 'required', 'when' => function ($model) { return $model->fax_secondary !== ''; }, 'whenClient' => "function (attribute, value) { return $(attribute).val() !== ''; }"],
            [['mobile_code'], 'exist', 'skipOnError' => true, 'targetClass' => Countriescodes::class, 'targetAttribute' => ['mobile_code' => 'id']],
            [['mobile_code'], 'required', 'when' => function ($model) { return $model->mobile !== ''; }, 'whenClient' => "function (attribute, value) { return $(attribute).val() !== ''; }"],
            [['mobile_secondary_code'], 'exist', 'skipOnError' => true, 'targetClass' => Countriescodes::class, 'targetAttribute' => ['mobile_secondary_code' => 'id']],
            [['mobile_secondary_code'], 'required', 'when' => function ($model) { return $model->mobile_secondary !== ''; }, 'whenClient' => "function (attribute, value) { return $(attribute).val() !== ''; }"],
            [['phone_code'], 'exist', 'skipOnError' => true, 'targetClass' => Countriescodes::class, 'targetAttribute' => ['phone_code' => 'id']],
            [['phone_code'], 'required', 'when' => function ($model) { return $model->phone !== ''; }, 'whenClient' => "function (attribute, value) { return $(attribute).val() !== ''; }"],
            [['phone_secondary_code'], 'exist', 'skipOnError' => true, 'targetClass' => Countriescodes::class, 'targetAttribute' => ['phone_secondary_code' => 'id']],
            [['phone_secondary_code'], 'required', 'when' => function ($model) { return $model->phone_secondary !== ''; }, 'whenClient' => "function (attribute, value) { return $(attribute).val() !== ''; }"],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(CreatedTrait::attributeLabels(), ModifiedTrait::attributeLabels(), StateTrait::attributeLabels(), UserTrait::attributeLabels(), [
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
            'rule' => Yii::t('traits', 'Rule'),
            'rule_type' => Yii::t('traits', 'Rule Type'),
            'note' => Yii::t('traits', 'Note'),
            'website' => Yii::t('traits', 'Website'),
            'skype' => Yii::t('traits', 'Skype'),
            'facebook' => Yii::t('traits', 'Facebook'),
            'gplus' => Yii::t('traits', 'Google Plus'),
            'instagram' => Yii::t('traits', 'Instagram'),
            'linkedin' => Yii::t('traits', 'Linkedin'),
            'twitter' => Yii::t('traits', 'Twitter'),
            'youtube' => Yii::t('traits', 'YouTube'),
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

	    if($this->$field && $this->$fieldcode) {
		    return '+' .$this->$fieldcode->phonecode. ' ' .$this->$field;
	    }

	    if($this->$field && !$this->$fieldcode) {
		    return $this->$field;
	    }

	    return '';
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
			'value'           => $this->accept ? '<span class="label label-success">' . \Yii::t('traits', 'Yes') . '</span>' : '<span class="label label-danger">' . \Yii::t('traits', 'No') . '</span>',
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
	 * Generate DetailView for Entry Informations
	 *
	 * @return string
	 * @throws \Exception
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
				'heading' => \Yii::t('traits', 'Entry Informations'),
				'type' => DetailView::TYPE_INFO,
			],
			'attributes' => [
				$this->getAcceptDetailView(),
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
     * @inheritdoc
     *
     * @return ContactsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ContactsQuery( static::class );
    }

}
