<?php

/**
 * @copyright Copyright &copy; Gogodigital Srls
 * @company Gogodigital Srls - Wide ICT Solutions
 * @website http://www.gogodigital.it
 * @github https://github.com/cinghie/yii2-contacts
 * @license GNU GENERAL PUBLIC LICENSE VERSION 3
 * @package yii2-contacts
 * @version 0.9.6
 */

namespace cinghie\contacts\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%countries_phonecode}}".
 *
 * @property integer $id
 * @property string $iso
 * @property string $name
 * @property string $nicename
 * @property string $iso3
 * @property int $numcode
 * @property int $phonecode
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
            'id' => Yii::t('traits', 'ID'),
            'iso' => Yii::t('contacts', 'Iso'),
            'name' => Yii::t('traits', 'Name'),
            'nicename' => Yii::t('traits', 'Nicename'),
            'iso3' => Yii::t('contacts', 'Iso3'),
            'numcode' => Yii::t('contacts', 'Numcode'),
            'phonecode' => Yii::t('contacts', 'Phonecode'),
        ];
    }

    /**
     * @inheritdoc
     *
     * @return CountriescodesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CountriescodesQuery( static::class );
    }
}
