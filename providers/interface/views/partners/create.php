<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var cms\models\Partners $model */

$this->title = 'Create Partners';
$this->params['breadcrumbs'][] = ['label' => 'Partners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partners-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
