<?php

/**
 * @copyright Copyright &copy; Gogodigital Srls
 * @company Gogodigital Srls - Wide ICT Solutions
 * @website http://www.gogodigital.it
 * @github https://github.com/cinghie/yii2-contacts
 * @license GNU GENERAL PUBLIC LICENSE VERSION 3
 * @package yii2-contacts
 * @version 0.9.3
 */

namespace cinghie\contacts\models;

use Yii;
use yii\db\ActiveRecord;
use cinghie\traits\CreatedTrait;
use cinghie\traits\ModifiedTrait;
use cinghie\traits\StateTrait;
use cinghie\traits\UserTrait;
use cinghie\traits\UserHelperTrait;
use cinghie\traits\ViewsHelper;

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
 * @property string $website
 * @property string $skype
 * @property string $facebook
 * @property string $gplus
 * @property string $instagram
 * @property string $linkedin
 * @property string $twitter
 * @property string $youtube
 *
 * @property Countriescodes $faxCode
 * @property Countriescodes $faxSecondaryCode
 * @property Countriescodes $mobileCode
 * @property Countriescodes $mobileSecondaryCode
 * @property Countriescodes $phoneCode
 * @property Countriescodes $phoneSecondaryCode
 */
class Contacts extends ActiveRecord
{
    
    use CreatedTrait;
    use ModifiedTrait;
    use StateTrait;
    use UserHelperTrait;
    use UserTrait;
    use ViewsHelper;

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
            [['email'], 'unique', 'targetAttribute' => ['email_secondary']],
            [['email_secondary'], 'unique', 'targetAttribute' => ['email']],
            [['email_secondary'], 'unique', 'targetAttribute' => ['email_secondary']],
            [['website'], 'url', 'defaultScheme' => 'http'],
            [['phone', 'phone_secondary', 'mobile', 'mobile_secondary', 'fax', 'fax_secondary'], 'string', 'max' => 50],
            [['firstname', 'lastname', 'email', 'email_secondary'], 'string', 'max' => 100],
            [['website', 'skype', 'facebook', 'gplus', 'instagram', 'linkedin', 'twitter', 'youtube'], 'string', 'max' => 255],
            [['phone_code', 'phone_secondary_code', 'mobile_code', 'mobile_secondary_code', 'fax_code', 'fax_secondary_code'], 'integer'],
            [['fax_code'], 'exist', 'skipOnError' => true, 'targetClass' => Countriescodes::className(), 'targetAttribute' => ['fax_code' => 'id']],
            [['fax_code'], 'required', 'when' => function ($model) { return $model->fax != ''; }, 'whenClient' => "function (attribute, value) { return $(attribute).val() != ''; }"],
            [['fax_secondary_code'], 'exist', 'skipOnError' => true, 'targetClass' => Countriescodes::className(), 'targetAttribute' => ['fax_secondary_code' => 'id']],
            [['fax_secondary_code'], 'required', 'when' => function ($model) { return $model->fax_secondary != ''; }, 'whenClient' => "function (attribute, value) { return $(attribute).val() != ''; }"],
            [['mobile_code'], 'exist', 'skipOnError' => true, 'targetClass' => Countriescodes::className(), 'targetAttribute' => ['mobile_code' => 'id']],
            [['mobile_code'], 'required', 'when' => function ($model) { return $model->mobile != ''; }, 'whenClient' => "function (attribute, value) { return $(attribute).val() != ''; }"],
            [['mobile_secondary_code'], 'exist', 'skipOnError' => true, 'targetClass' => Countriescodes::className(), 'targetAttribute' => ['mobile_secondary_code' => 'id']],
            [['mobile_secondary_code'], 'required', 'when' => function ($model) { return $model->mobile_secondary != ''; }, 'whenClient' => "function (attribute, value) { return $(attribute).val() != ''; }"],
            [['phone_code'], 'exist', 'skipOnError' => true, 'targetClass' => Countriescodes::className(), 'targetAttribute' => ['phone_code' => 'id']],
            [['phone_code'], 'required', 'when' => function ($model) { return $model->phone != ''; }, 'whenClient' => "function (attribute, value) { return $(attribute).val() != ''; }"],
            [['phone_secondary_code'], 'exist', 'skipOnError' => true, 'targetClass' => Countriescodes::className(), 'targetAttribute' => ['phone_secondary_code' => 'id']],
            [['phone_secondary_code'], 'required', 'when' => function ($model) { return $model->phone_secondary != ''; }, 'whenClient' => "function (attribute, value) { return $(attribute).val() != ''; }"],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(CreatedTrait::attributeLabels(), ModifiedTrait::attributeLabels(), StateTrait::attributeLabels(), UserTrait::attributeLabels(), [
            'id' => Yii::t('contacts', 'ID'),
            'firstname' => Yii::t('contacts', 'Firstname'),
            'lastname' => Yii::t('contacts', 'Lastname'),
            'email' => Yii::t('contacts', 'Email'),
            'email_secondary' => Yii::t('contacts', 'Email Secondary'),
            'phone' => Yii::t('contacts', 'Phone'),
            'phone_code' => Yii::t('contacts', 'Phone Code'),
            'phone_secondary' => Yii::t('contacts', 'Phone Secondary'),
            'phone_secondary_code' => Yii::t('contacts', 'Phone Secondary Code'),
            'mobile' => Yii::t('contacts', 'Mobile'),
            'mobile_code' => Yii::t('contacts', 'Mobile Code'),
            'mobile_secondary' => Yii::t('contacts', 'Mobile Secondary'),
            'mobile_secondary_code' => Yii::t('contacts', 'Mobile Secondary Code'),
            'fax' => Yii::t('contacts', 'Fax'),
            'fax_code' => Yii::t('contacts', 'Fax Code'),
            'fax_secondary' => Yii::t('contacts', 'Fax Secondary'),
            'fax_secondary_code' => Yii::t('contacts', 'Fax Secondary Code'),
            'website' => Yii::t('contacts', 'Website'),
            'skype' => Yii::t('contacts', 'Skype'),
            'facebook' => Yii::t('contacts', 'Facebook'),
            'gplus' => Yii::t('contacts', 'Gplus'),
            'instagram' => Yii::t('contacts', 'Instagram'),
            'linkedin' => Yii::t('contacts', 'Linkedin'),
            'twitter' => Yii::t('contacts', 'Twitter'),
            'youtube' => Yii::t('contacts', 'Youtube'),
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVatCodePrefix()
    {
        return $this->hasOne(Countriescodes::className(), ['id' => 'vat_code_prefix']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhoneCode()
    {
        return $this->hasOne(Countriescodes::className(), ['id' => 'phone_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhoneSecondaryCode()
    {
        return $this->hasOne(Countriescodes::className(), ['id' => 'phone_secondary_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMobileCode()
    {
        return $this->hasOne(Countriescodes::className(), ['id' => 'mobile_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMobileSecondaryCode()
    {
        return $this->hasOne(Countriescodes::className(), ['id' => 'mobile_secondary_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaxCode()
    {
        return $this->hasOne(Countriescodes::className(), ['id' => 'fax_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaxSecondaryCode()
    {
        return $this->hasOne(Countriescodes::className(), ['id' => 'fax_secondary_code']);
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
     * Return array for Publish Status
     *
     * @return array
     */
    public function getPublishSelect2()
    {
        if ( Yii::$app->user->can('contacts-publish-all-contacts') || Yii::$app->user->can('contacts-publish-his-contacts') ) {
            return [ 1 => Yii::t('contacts', 'Actived'), 0 => Yii::t('contacts', 'Inactived') ];
        } else {
            return [ 0 => Yii::t('contacts', 'Inactived') ];
        }
    }

    /**
     * @inheritdoc
     *
     * @return ContactsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ContactsQuery(get_called_class());
    }

}
