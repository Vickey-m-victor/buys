<?php

use cms\models\Products;
use helpers\Html;
use yii\helpers\Url;
use helpers\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var cms\models\searches\ProductsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index row">
    <div class="col-md-12">
      <div class="block block-rounded">
        <div class="block-header block-header-default">
          <h3 class="block-title"><?= Html::encode($this->title) ?> </h3>
          <div class="block-options">
          <?=  Html::customButton([
            'type' => 'modal',
            'url' => Url::to(['create']),
            'appearence' => [
              'type' => 'text',
              'text' => 'Create Products',
              'theme' => 'primary',
              'visible' => Yii::$app->user->can('cms-products-create', true)
            ],
            'modal' => ['title' => 'New Products']
          ]) ?>
          </div> 
        </div>
        <div class="block-content">     
    <?php Pjax::begin(); ?>
    <div class="products-search my-3">
    <?= $this->render('_search', ['model' => $searchModel]); ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'description:ntext',
            'technology',
            [
              'attribute' => 'imageURL',
              'format' => 'html', // Render as HTML
              'value' => function ($model) {
                  return Html::img($model->imageURL, ['alt' => $model->title, 'style' => 'width: 100px;']);
              },
          ],
            //'is_published',
            //'is_deleted',
            //'created_at',
            //'updated_at',
            [
                'class' => \helpers\grid\ActionColumn::className(),
                'template' => '{update} {trash}',
                'headerOptions' => ['width' => '8%'],
                'contentOptions' => ['style'=>'text-align: center;'],
                 'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::customButton(['type' => 'modal', 'url' => Url::toRoute(['update', 'id' => $model->id]), 'modal' => ['title' => 'Update  Products'], 'appearence' => ['icon' => 'edit', 'theme' => 'info']]);
                    },
                    'trash' => function ($url, $model, $key) {
                        return $model->is_deleted !== 1 ?
                            Html::customButton(['type' => 'link', 'url' => Url::toRoute(['trash', 'id' => $model->id]),  'appearence' => ['icon' => 'trash', 'theme' => 'danger', 'data' => ['message' => 'Do you want to delete this products?']]]) :
                            Html::customButton(['type' => 'link', 'url' => Url::toRoute(['trash', 'id' => $model->id]),  'appearence' => ['icon' => 'undo', 'theme' => 'warning', 'data' => ['message' => 'Do you want to restore this products?']]]);
                    },
                ],
                'visibleButtons' => [
                    'update' => Yii::$app->user->can('cms-products-update',true),
                    'trash' => function ($model){
                         return $model->is_deleted !== 1 ? 
                                Yii::$app->user->can('cms-products-delete',true) : 
                                Yii::$app->user->can('cms-products-restore',true);
                    },
                ],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
</div>
      </div>
    </div>