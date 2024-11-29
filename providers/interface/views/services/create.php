<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var cms\models\Services $model */

$this->title = 'Create Services';
$this->params['breadcrumbs'][] = ['label' => 'Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="services-create">

  

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
