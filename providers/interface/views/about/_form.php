<?php

use helpers\Html;
use helpers\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var cms\models\About $model */
/** @var helpers\widgets\ActiveForm $form */
?>

<div class="about-form">
    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true, 'enctype' => 'multipart/form-data']]); ?>
    <div class="row">
        <div class="col-md-12">
          <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-12">
          <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-md-12">
          <?= $form->field($model, 'file')->fileInput(['onchange' => 'previewAboutImage(event)']) ?>
        </div>

        <!-- Preview Section -->
        <div class="col-md-12 mb-3">
            <?php if ($model->imageURL): ?>
                <label>Current Image:</label>
                <div>
                    <img id="about-image-preview" src="<?= $model->imageURL ?>" alt="About Image Preview" style="max-width: 150px; max-height: 150px;">
                </div>
            <?php else: ?>
                <div>
                    <img id="about-image-preview" src="#" alt="No Image Selected" style="display: none; max-width: 150px; max-height: 150px;">
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="block-content block-content-full text-center">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<script>
function previewAboutImage(event) {
    const preview = document.getElementById('about-image-preview');
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
