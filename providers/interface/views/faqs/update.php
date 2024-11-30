<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var cms\models\Faqs $model */

$this->title = 'Update Faqs: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Faqs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="faqs-update">

   
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
