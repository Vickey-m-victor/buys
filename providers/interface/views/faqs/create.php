<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var cms\models\Faqs $model */

$this->title = 'Create Faqs';
$this->params['breadcrumbs'][] = ['label' => 'Faqs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faqs-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
