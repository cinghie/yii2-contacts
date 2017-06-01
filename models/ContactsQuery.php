<?php

/**
 * @copyright Copyright &copy; Gogodigital Srls
 * @company Gogodigital Srls - Wide ICT Solutions
 * @website http://www.gogodigital.it
 * @github https://github.com/cinghie/yii2-contacts
 * @license GNU GENERAL PUBLIC LICENSE VERSION 3
 * @package yii2-contacts
 * @version 0.9.0
 */

namespace cinghie\contacts\models;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Contacts]].
 *
 * @see Contacts
 */
class ContactsQuery extends ActiveQuery
{

    /**
     * @inheritdoc
     * @return Contacts[]|array
     */
    public function active()
    {
        return $this->andWhere('[[state]]=1');
    }

    /**
     * @inheritdoc
     * @return Contacts[]|array
     */
    public function inactive()
    {
        return $this->andWhere('[[state]]=0');
    }

    /**
     * @inheritdoc
     * @return Contacts[]|array
     */
    public function last($limit, $orderby = "id", $order = "DESC")
    {
        return $this->orderBy([$orderby => $order])->limit($limit);
    }

    /**
     * @inheritdoc
     * @return Contacts[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Contacts|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

}
