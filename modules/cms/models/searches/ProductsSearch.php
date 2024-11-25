<?php

namespace cms\models\searches;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use cms\models\Products;

/**
 * ProductsSearch represents the model behind the search form of `cms\models\Products`.
 */
class ProductsSearch extends Products
{
    /**
     * {@inheritdoc}
     */
    public $globalSearch;
    public function rules()
    {
        return [
            [['id', 'is_published', 'is_deleted', 'created_at', 'updated_at'], 'integer'],
            [['title', 'description', 'technology', 'imageURL'], 'safe'],
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
        $query = Products::find();

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
            'is_published' => $this->globalSearch,
            'is_deleted' => $this->globalSearch,
            'created_at' => $this->globalSearch,
            'updated_at' => $this->globalSearch,
        ]);

        $query->orFilterWhere(['like', 'title', $this->globalSearch])
            ->orFilterWhere(['like', 'description', $this->globalSearch])
            ->orFilterWhere(['like', 'technology', $this->globalSearch])
            ->orFilterWhere(['like', 'imageURL', $this->globalSearch]);
        }else{
                $query->andFilterWhere([
            'id' => $this->id,
            'is_published' => $this->is_published,
            'is_deleted' => $this->is_deleted,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'technology', $this->technology])
            ->andFilterWhere(['like', 'imageURL', $this->imageURL]);
        }
        return $dataProvider;
    }
}
