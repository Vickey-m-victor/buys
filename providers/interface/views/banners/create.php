<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var cms\models\Banners $model */

$this->title = 'Add Banner';
$this->params['breadcrumbs'][] = ['label' => 'Banners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banners-create">

  

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
