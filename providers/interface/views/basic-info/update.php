<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var cms\models\BasicInfo $model */

$this->title = 'Update Basic Info: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Basic Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="basic-info-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
