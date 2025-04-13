<?php

/**
 * @copyright Copyright &copy; Gogodigital Srls
 * @company Gogodigital Srls - Wide ICT Solutions
 * @website http://www.gogodigital.it
 * @github https://github.com/cinghie/yii2-contacts
 * @license GNU GENERAL PUBLIC LICENSE VERSION 3
 * @package yii2-contacts
 * @version 0.9.8
 */

namespace cinghie\contacts\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ContactsSearch represents the model behind the search form about `cinghie\contacts\models\Contacts`.
 */
class ContactsSearch extends Contacts
{
    /**
     * @var string
     */
    public $name;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'vat_code_prefix', 'accept', 'accept_secondary', 'phone_code', 'phone_secondary_code', 'mobile_code', 'mobile_secondary_code', 'fax_code', 'fax_secondary_code', 'state', 'user_id', 'created_by', 'modified_by'], 'integer'],
            [['firstname', 'lastname', 'tax_code', 'vat_code', 'sdi', 'pec', 'email', 'email_secondary', 'phone', 'phone_secondary', 'mobile', 'mobile_secondary', 'fax', 'fax_secondary', 'rule', 'rule_type', 'billing_street', 'billing_code', 'billing_city', 'billing_province', 'billing_state', 'billing_country', 'shipping_street', 'shipping_code', 'shipping_city', 'shipping_province', 'shipping_state', 'shipping_country', 'note', 'website', 'skype', 'facebook', 'instagram', 'linkedin', 'twitter', 'youtube', 'pinterest', 'created', 'modified'], 'safe'],
            [['billing_lat', 'billing_lng', 'shipping_lat', 'shipping_lng'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Contacts::find();
        $query->joinWith(['createdBy', 'modifiedBy','user']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id',
                'name' => [
                    'asc' => [ 'lastname' => SORT_ASC, 'firstname' => SORT_ASC ],
                    'desc' => [ 'lastname' => SORT_DESC, 'firstname' => SORT_DESC ],
                    'default' => SORT_ASC
                ],
                'email',
	            'accept',
                'email_secondary',
	            'accept_secondary',
                'phone',
                'phone_secondary',
                'mobile',
	            'mobile_secondary',
	            'fax',
	            'fax_secondary',
	            'rule',
	            'rule_type',
                'state',
                'user_id',
                'created',
                'created_by',
                'modified',
                'modified_by',
            ],
            'defaultOrder' => [
                'id' => SORT_DESC
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'state' => $this->state,
            'accept' => $this->accept,
            'accept_secondary' => $this->accept_secondary,
        ]);

        $query->andFilterWhere(['OR',['like', 'firstname', $this->name],['like', 'lastname', $this->name]])
            ->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'user.username', $this->user_id])
            ->andFilterWhere(['like', 'created', $this->created])
            ->andFilterWhere(['like', 'createdby.username', $this->created_by])
            ->andFilterWhere(['like', 'modified', $this->modified])
            ->andFilterWhere(['like', 'modifiedby.username', $this->modified_by])
            ->andFilterWhere(['like', '{{%contacts}}.email', $this->email])
            ->andFilterWhere(['like', 'email_secondary', $this->email_secondary])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'phone_secondary', $this->phone_secondary])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'mobile_secondary', $this->mobile_secondary])
            ->andFilterWhere(['like', 'fax', $this->fax])
            ->andFilterWhere(['like', 'fax_secondary', $this->fax_secondary])
            ->andFilterWhere(['like', 'rule', $this->rule])
            ->andFilterWhere(['like', 'rule_type', $this->rule_type])
            ->andFilterWhere(['like', 'sdi', $this->sdi])
            ->andFilterWhere(['like', 'pec', $this->pec])
            ->andFilterWhere(['like', 'billing_street', $this->billing_street])
            ->andFilterWhere(['like', 'billing_code', $this->billing_code])
            ->andFilterWhere(['like', 'billing_city', $this->billing_city])
            ->andFilterWhere(['like', 'billing_province', $this->billing_province])
            ->andFilterWhere(['like', 'billing_state', $this->billing_state])
            ->andFilterWhere(['like', 'billing_country', $this->billing_country])
            ->andFilterWhere(['like', 'shipping_street', $this->shipping_street])
            ->andFilterWhere(['like', 'shipping_code', $this->shipping_code])
            ->andFilterWhere(['like', 'shipping_city', $this->shipping_city])
            ->andFilterWhere(['like', 'shipping_province', $this->shipping_province])
            ->andFilterWhere(['like', 'shipping_state', $this->shipping_state])
            ->andFilterWhere(['like', 'shipping_country', $this->shipping_country])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'website', $this->website])
            ->andFilterWhere(['like', 'skype', $this->skype])
            ->andFilterWhere(['like', 'facebook', $this->facebook])
            ->andFilterWhere(['like', 'instagram', $this->instagram])
            ->andFilterWhere(['like', 'linkedin', $this->linkedin])
            ->andFilterWhere(['like', 'twitter', $this->twitter])
            ->andFilterWhere(['like', 'youtube', $this->youtube])
            ->andFilterWhere(['like', 'pinterest', $this->pinterest]);;

        // Print SQL query
        //var_dump($query->createCommand()->sql); //exit();

        return $dataProvider;
    }

    /**
     * Creates data provider instance with last contacts
     *
     * @param $limit
     * @param string $orderby
     * @param int $order
     *
     * @return ActiveDataProvider
     */
    public function last($limit = 5, $orderby = 'id', $order = SORT_DESC)
    {
        $query = Contacts::find()->limit($limit);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $limit,
            ],
            'sort' => [
                'defaultOrder' => [
                    $orderby => $order
                ],
            ],
            'totalCount' => $limit
        ]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }
}
