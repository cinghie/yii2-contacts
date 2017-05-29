<?php

/**
 * @copyright Copyright &copy; Gogodigital Srls
 * @company Gogodigital Srls - Wide ICT Solutions
 * @website http://www.gogodigital.it
 * @package yii2-crm
 * @version 0.2.5
 */

namespace cinghie\crm\models;

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
     * @return Countriescodes[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Countriescodes|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

}
