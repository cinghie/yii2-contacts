<?php

/**
 * @copyright Copyright &copy; Gogodigital Srls
 * @company Gogodigital Srls - Wide ICT Solutions
 * @website http://www.gogodigital.it
 * @github https://github.com/cinghie/yii2-contacts
 * @license GNU GENERAL PUBLIC LICENSE VERSION 3
 * @package yii2-contacts
 * @version 0.1.0
 */

namespace cinghie\contacts\models;

use yii\db\ActiveRecord;
use cinghie\yii2userextended\models\User;

/**
 * This is the model class for table "{{%contacts}}".
 *
 * @property int $id
 * @property int $user_id
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
 * @property string $twitter
 * @property string $linkedin
 * @property int $state
 * @property int $created_by
 * @property string $created
 * @property int $modified_by
 * @property string $modified
 *
 * @property Countriescodes $faxCode
 * @property Countriescodes $faxSecondaryCode
 * @property Countriescodes $mobileCode
 * @property Countriescodes $mobileSecondaryCode
 * @property Countriescodes $phoneCode
 * @property Countriescodes $phoneSecondaryCode
 * @property User $createdBy
 * @property User $modifiedBy
 */
class Contacts extends ActiveRecord
{

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
        return [
            [['firstname', 'lastname', 'created_by'], 'required'],
            ['phone_code', 'required', 'when' => function ($model) {
                    return $model->phone != '';
                }, 'whenClient' => "function (attribute, value) {
                    return $('#contacts-phone').val() != '';
            }"],
            ['phone_secondary_code', 'required', 'when' => function ($model) {
                    return $model->phone_secondary != '';
                }, 'whenClient' => "function (attribute, value) {
                    return $('#contacts-phone_secondary').val() != '';
            }"],
            ['mobile_code', 'required', 'when' => function ($model) {
                    return $model->mobile != '';
                }, 'whenClient' => "function (attribute, value) {
                    return $('#contacts-mobile').val() != '';
            }"],
            ['mobile_secondary_code', 'required', 'when' => function ($model) {
                    return $model->mobile_secondary != '';
                }, 'whenClient' => "function (attribute, value) {
                    return $('#contacts-mobile_secondary').val() != '';
            }"],
            ['fax_code', 'required', 'when' => function ($model) {
                return $model->fax != '';
            }, 'whenClient' => "function (attribute, value) {
                    return $('#contacts-fax').val() != '';
            }"],
            ['fax_secondary_code', 'required', 'when' => function ($model) {
                return $model->fax_secondary != '';
            }, 'whenClient' => "function (attribute, value) {
                    return $('#contacts-fax_secondary').val() != '';
            }"],
            [['created', 'modified'], 'safe'],
            [['user_id', 'phone_code', 'phone_secondary_code', 'mobile_code', 'mobile_secondary_code', 'fax_code', 'fax_secondary_code', 'state', 'created_by', 'modified_by'], 'integer'],
            [['phone', 'phone_secondary', 'mobile', 'mobile_secondary', 'fax', 'fax_secondary'], 'string', 'max' => 50],
            [['firstname', 'lastname', 'email', 'email_secondary'], 'string', 'max' => 100],
            [['website', 'skype', 'facebook', 'gplus', 'twitter', 'linkedin'], 'string', 'max' => 255],
            [['fax_code'], 'exist', 'skipOnError' => true, 'targetClass' => Countriescodes::className(), 'targetAttribute' => ['fax_code' => 'id']],
            [['fax_secondary_code'], 'exist', 'skipOnError' => true, 'targetClass' => Countriescodes::className(), 'targetAttribute' => ['fax_secondary_code' => 'id']],
            [['mobile_code'], 'exist', 'skipOnError' => true, 'targetClass' => Countriescodes::className(), 'targetAttribute' => ['mobile_code' => 'id']],
            [['mobile_secondary_code'], 'exist', 'skipOnError' => true, 'targetClass' => Countriescodes::className(), 'targetAttribute' => ['mobile_secondary_code' => 'id']],
            [['modified_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['modified_by' => 'id']],
            [['phone_code'], 'exist', 'skipOnError' => true, 'targetClass' => Countriescodes::className(), 'targetAttribute' => ['phone_code' => 'id']],
            [['phone_secondary_code'], 'exist', 'skipOnError' => true, 'targetClass' => Countriescodes::className(), 'targetAttribute' => ['phone_secondary_code' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['modified_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['modified_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => \Yii::t('contacts', 'ID'),
            'user_id' => \Yii::t('contacts', 'Userid'),
            'firstname' => \Yii::t('contacts', 'Firstname'),
            'lastname' => \Yii::t('contacts', 'Lastname'),
            'email' => \Yii::t('contacts', 'Email'),
            'email_secondary' => \Yii::t('contacts', 'Email Secondary'),
            'phone' => \Yii::t('contacts', 'Phone'),
            'phone_code' => \Yii::t('contacts', 'Phone Code'),
            'phone_secondary' => \Yii::t('contacts', 'Phone Secondary'),
            'phone_secondary_code' => \Yii::t('contacts', 'Phone Secondary Code'),
            'mobile' => \Yii::t('contacts', 'Mobile'),
            'mobile_code' => \Yii::t('contacts', 'Mobile Code'),
            'mobile_secondary' => \Yii::t('contacts', 'Mobile Secondary'),
            'mobile_secondary_code' => \Yii::t('contacts', 'Mobile Secondary Code'),
            'fax' => \Yii::t('contacts', 'Fax'),
            'fax_code' => \Yii::t('contacts', 'Fax Code'),
            'fax_secondary' => \Yii::t('contacts', 'Fax Secondary'),
            'fax_secondary_code' => \Yii::t('contacts', 'Fax Secondary Code'),
            'website' => \Yii::t('contacts', 'Website'),
            'skype' => \Yii::t('contacts', 'Skype'),
            'facebook' => \Yii::t('contacts', 'Facebook'),
            'gplus' => \Yii::t('contacts', 'Gplus'),
            'linkedin' => \Yii::t('contacts', 'Linkedin'),
            'twitter' => \Yii::t('contacts', 'Twitter'),
            'state' => \Yii::t('contacts', 'State'),
            'created' => \Yii::t('contacts', 'Created'),
            'created_by' => \Yii::t('contacts', 'Created By'),
            'modified' => \Yii::t('contacts', 'Modified'),
        ];
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
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModifiedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'modified_by']);
    }

    /**
     * Return Contact Full Name
     * @return string
     */
    public function getFullName()
    {
        return $this->lastname . ' ' . $this->firstname;
    }

    /**
     * Active the item setting state = 1
     * @return bool
     */
    public function active()
    {
        return (bool)$this->updateAttributes([
            'state' => 1
        ]);
    }

    /**
     * Inactive the item setting state = 0
     * @return bool
     */
    public function inactive()
    {
        return (bool)$this->updateAttributes([
            'state' => 0
        ]);
    }

    /**
     * Get the user_id By user email
     * @param $email
     * @return integer
     */
    public function getUserIDByEmail($email)
    {
        $user = User::find()
            ->select(['*'])
            ->where(['email' => $email])
            ->one();

        return $user['id'];
    }

    /**
     * Return array for Publish Status
     * @return array
     */
    public function getPublishSelect2()
    {
        if ( \Yii::$app->user->can('contacts-publish-all-contacts') || \Yii::$app->user->can('contacts-publish-his-contacts') ) {
            return [ 1 => \Yii::t('contacts', 'Actived'), 0 => \Yii::t('contacts', 'Inactived') ];
        } else {
            return [ 0 => \Yii::t('contacts', 'Inactived') ];
        }
    }

    /**
     * @inheritdoc
     * @return ContactsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ContactsQuery(get_called_class());
    }

}
