<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var cms\models\ContactInfo $model */

$this->title = 'Update Contact Infomation: ' ;
$this->params['breadcrumbs'][] = ['label' => 'Contact Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="contact-info-update">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
