<?php

use helpers\Html;
use helpers\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var cms\models\Faqs $model */
/** @var helpers\widgets\ActiveForm $form */
?>

<div class="faqs-form">
    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]);?>
    <div class="row">
        <div class="col-md-12">
          <?= $form->field($model, 'question')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-12">
          <?= $form->field($model, 'answer')->textarea(['rows' => 6]) ?>
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
