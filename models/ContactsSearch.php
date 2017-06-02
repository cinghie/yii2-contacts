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
            [['id', 'user_id',  'created_by', 'modified_by', 'state'], 'integer'],
            [['name','firstname', 'lastname', 'email', 'email_secondary', 'phone', 'phone_code', 'phone_secondary', 'phone_secondary_code', 'mobile', 'mobile_code', 'mobile_secondary', 'mobile_secondary_code', 'skype', 'created', 'modified'], 'safe'],
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
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Contacts::find();

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
                'email_secondary',
                'phone',
                'phone_secondary',
                'mobile',
                'mobile_secondary',
                'state'
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
            'user_id' => $this->user_id,
            'state' => $this->state,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['OR',['like', 'firstname', $this->name],['like', 'lastname', $this->name]])
            ->andFilterWhere(['like', 'concat(firstname, " " , lastname) ', $this->name])
            ->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'email_secondary', $this->email_secondary])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'phone_code', $this->phone_code])
            ->andFilterWhere(['like', 'phone_secondary', $this->phone_secondary])
            ->andFilterWhere(['like', 'phone_secondary_code', $this->phone_secondary_code])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'mobile_code', $this->mobile_code])
            ->andFilterWhere(['like', 'mobile_secondary', $this->mobile_secondary])
            ->andFilterWhere(['like', 'mobile_secondary_code', $this->mobile_secondary_code])
            ->andFilterWhere(['like', 'fax', $this->fax])
            ->andFilterWhere(['like', 'fax_code', $this->fax_code])
            ->andFilterWhere(['like', 'fax_secondary', $this->fax_secondary])
            ->andFilterWhere(['like', 'fax_secondary_code', $this->fax_secondary_code])
            ->andFilterWhere(['like', 'website', $this->website])
            ->andFilterWhere(['like', 'facebook', $this->facebook])
            ->andFilterWhere(['like', 'gplus', $this->gplus])
            ->andFilterWhere(['like', 'linkedin', $this->linkedin])
            ->andFilterWhere(['like', 'skype', $this->skype])
            ->andFilterWhere(['like', 'twitter', $this->twitter]);

        // Print SQL query
        //var_dump($query->createCommand()->sql); //exit();

        return $dataProvider;
    }

    /**
     * Creates data provider instance with last contacts
     * @param integer $count
     * @return ActiveDataProvider
     */
    public function last($limit, $orderby = "id", $order = SORT_DESC)
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
