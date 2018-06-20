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

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Countriescodes]].
 *
 * @see Countriescodes
 */
class CountriescodesQuery extends ActiveQuery
{

    /**
     * @inheritdoc
     *
     * @return Countriescodes[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     *
     * @return Countriescodes|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

}
