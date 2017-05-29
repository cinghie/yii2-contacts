<?php

/**
 * @copyright Copyright &copy; Gogodigital Srls
 * @company Gogodigital Srls - Wide ICT Solutions
 * @website http://www.gogodigital.it
 * @package yii2-crm
 * @version 0.2.5
 */

namespace cinghie\crm\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%countries_phonecode}}".
 *
 * @property integer $id
 * @property string $iso
 * @property string $name
 * @property string $nicename
 * @property string $iso3
 * @property integer $numcode
 * @property integer $phonecode
 */
class Countriescodes extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%countries_phonecode}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['iso', 'name', 'nicename', 'phonecode'], 'required'],
            [['numcode', 'phonecode'], 'integer'],
            [['iso'], 'string', 'max' => 2],
            [['name', 'nicename'], 'string', 'max' => 80],
            [['iso3'], 'string', 'max' => 3],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => \Yii::t('crm', 'ID'),
            'iso' => \Yii::t('crm', 'Iso'),
            'name' => \Yii::t('crm', 'Name'),
            'nicename' => \Yii::t('crm', 'Nicename'),
            'iso3' => \Yii::t('crm', 'Iso3'),
            'numcode' => \Yii::t('crm', 'Numcode'),
            'phonecode' => \Yii::t('crm', 'Phonecode'),
        ];
    }

    /**
     * @inheritdoc
     * @return CountriescodesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CountriescodesQuery(get_called_class());
    }

}
