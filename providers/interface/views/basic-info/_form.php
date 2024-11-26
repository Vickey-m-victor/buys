<?php

use helpers\Html;
use helpers\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var cms\models\BasicInfo $model */
/** @var helpers\widgets\ActiveForm $form */
?>

<div class="basic-info-form">
    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true, 'enctype' => 'multipart/form-data']]); ?>
    <div class="row">
        <div class="col-md-12">
          <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-12">
          <?= $form->field($model, 'file')->fileInput(['onchange' => 'previewImage(event)']) ?>
        </div>

        <!-- Preview Section -->
        <div class="col-md-12 mb-3">
            <?php if ($model->logoUrl): ?>
                <label>Current Logo:</label>
                <div>
                    <img id="logo-preview" src="<?= $model->logoUrl ?>" alt="Logo Preview" style="max-width: 150px; max-height: 150px;">
                </div>
            <?php else: ?>
                <div>
                    <img id="logo-preview" src="#" alt="No Logo Selected" style="display: none; max-width: 150px; max-height: 150px;">
                </div>
            <?php endif; ?>
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
    </div>
    <div class="block-content block-content-full text-center">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<script>
function previewImage(event) {
    const preview = document.getElementById('logo-preview');
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
    }
}
</script>
