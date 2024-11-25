<?php

namespace cms\models\searches;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use cms\models\BasicInfo;

/**
 * BasicInfoSearch represents the model behind the search form of `cms\models\BasicInfo`.
 */
class BasicInfoSearch extends BasicInfo
{
    /**
     * {@inheritdoc}
     */
    public $globalSearch;
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'logoUrl', 'url', 'mission', 'vision'], 'safe'],
            ['globalSearch', 'safe']
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
        $query = BasicInfo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [ 'defaultPageSize' => \Yii::$app->params['defaultPageSize'], 'pageSizeLimit' => [1, \Yii::$app->params['pageSizeLimit']]],
            'sort'=> ['defaultOrder' => ['created_at'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        if(isset($this->globalSearch)){
                $query->orFilterWhere([
            'id' => $this->globalSearch,
        ]);

        $query->orFilterWhere(['like', 'name', $this->globalSearch])
            ->orFilterWhere(['like', 'logoUrl', $this->globalSearch])
            ->orFilterWhere(['like', 'url', $this->globalSearch])
            ->orFilterWhere(['like', 'mission', $this->globalSearch])
            ->orFilterWhere(['like', 'vision', $this->globalSearch]);
        }else{
                $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'logoUrl', $this->logoUrl])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'mission', $this->mission])
            ->andFilterWhere(['like', 'vision', $this->vision]);
        }
        return $dataProvider;
    }
}
