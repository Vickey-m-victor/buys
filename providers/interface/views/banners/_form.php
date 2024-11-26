<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var cms\models\Banners $model */
/** @var yii\bootstrap5\ActiveForm $form */
?>

<div class="banners-form">
    <h2>Banner Details</h2> <!-- Add a title for the form -->
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'file')->fileInput() ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'is_published')->radioList(
                [1 => 'Published', 0 => 'Unpublished'] // Radio options
            ) ?>
        </div>
    </div>

    <div class="text-center mt-3">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
