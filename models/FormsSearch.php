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

use yii\base\Model;
use yii\data\ActiveDataProvider;
use cinghie\contacts\models\Forms;

/**
 * FormsSearch represents the model behind the search form of `cinghie\contacts\models\Forms`.
 */
class FormsSearch extends Forms
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'contact_id','captcha'], 'integer'],
	        [['title'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Forms::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'contact_id' => $this->contact_id,
            'captcha' => $this->captcha,
        ]);

	    $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
