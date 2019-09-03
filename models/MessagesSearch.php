<?php

namespace cinghie\contacts\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * MessagesSearch represents the model behind the search form of `cinghie\contacts\models\Messages`.
 */
class MessagesSearch extends Messages
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ip'], 'integer'],
            [['name', 'firstname', 'lastname', 'email', 'phone', 'mobile', 'message', 'created_by', 'created'], 'safe'],
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
        $query = Messages::find();
	    $query->joinWith(['createdBy']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

	    $dataProvider->setSort([
		    'defaultOrder' => [
			    'created' => SORT_DESC
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
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'message', $this->message])
	        ->andFilterWhere(['like', 'created', $this->created])
	        ->andFilterWhere(['like', 'createdby.username', $this->created_by])
	        ->andFilterWhere(['like', 'ip', $this->ip]);

        return $dataProvider;
    }
}
