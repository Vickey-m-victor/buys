<?php

use helpers\Html;
use helpers\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var cms\models\BasicInfo $model */
/** @var helpers\widgets\ActiveForm $form */
?>

<div class="basic-info-form">
    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true, 'enctype' => 'multipart/form-data']]);?>
    <div class="row">
        <div class="col-md-12">
          <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-12">
          <?= $form->field($model, 'file')->fileInput() ?>
        </div>
        <div class="col-md-12">
          <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-12">
          <?= $form->field($model, 'mission')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-12">
          <?= $form->field($model, 'vision')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-12">
    <?= $form->field($model, 'is_published')->radioList(
        [1 => 'Published', 0 => 'Unpublished'] // Radio options
    ) ?>
</div>
    </div>
    <div class="block-content block-content-full text-center">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
