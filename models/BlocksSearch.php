<?php

namespace x51\yii2\modules\blocks\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use x51\yii2\modules\blocks\models\Blocks;

/**
 * BlocksSearch represents the model behind the search form of `x51\yii2\modules\blocks\models\Blocks`.
 */
class BlocksSearch extends Blocks
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'sort'], 'integer'],
            [['code', 'content', 'bgroup', 'permission', 'name', 'epilog', 'intro'], 'safe'],
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
        $query = Blocks::find();

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
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'permission', $this->permission])
            ->andFilterWhere(['like', 'route', $this->route]);

        return $dataProvider;
    }
}
