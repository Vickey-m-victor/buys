<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var cms\models\BasicInfo $model */

$this->title = 'Create Basic Info';
$this->params['breadcrumbs'][] = ['label' => 'Basic Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="basic-info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
