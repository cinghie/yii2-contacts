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

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[ContactForm]].
 *
 * @see ContactForm
 */
class ContactFormQuery extends ActiveQuery
{
    /**
     * @inheritdoc
     *
     * @param int $limit
     * @param string $order
     * @param string $orderby
     *
     * @return ContactFormQuery
     */
    public function last($limit, $orderby = 'id', $order = 'DESC' )
    {
        return $this->orderBy([$orderby => $order])->limit($limit);
    }

    /**
     * @inheritdoc
     *
     * @return ContactForm[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     *
     * @return ContactForm|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
