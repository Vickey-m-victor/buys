<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var cms\models\Socials $model */

$this->title = 'Create Socials';
$this->params['breadcrumbs'][] = ['label' => 'Socials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="socials-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
