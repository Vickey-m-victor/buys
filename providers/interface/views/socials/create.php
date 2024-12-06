<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var cms\models\Socials $model */

$this->title = 'Create Socials';
$this->params['breadcrumbs'][] = ['label' => 'Socials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="socials-create">

   

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
