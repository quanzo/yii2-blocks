<?php

namespace x51\yii2\modules\blocks\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use x51\yii2\modules\blocks\models\BlocksGarbage;

/**
 * BlocksGarbageSearch represents the model behind the search form of `x51\yii2\modules\blocks\models\BlocksGarbage`.
 */
class BlocksGarbageSearch extends BlocksGarbage
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sort', 'user_id', 'garbage_id', 'active'], 'integer'],
            [['code', 'bgroup', 'name', 'intro', 'content', 'epilog', 'comment', 'callback', 'garbage_date', 'garbage_op', 'permission'], 'safe'],
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
        $query = BlocksGarbage::find();

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
            'sort' => $this->sort,
            'user_id' => $this->user_id,
            'garbage_id' => $this->garbage_id,
            'garbage_date' => $this->garbage_date,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'bgroup', $this->group])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'callback', $this->callback])
			->andFilterWhere(['like', 'permission', $this->permission])
            ->andFilterWhere(['like', 'garbage_op', $this->garbage_op]);

        return $dataProvider;
    }
}
