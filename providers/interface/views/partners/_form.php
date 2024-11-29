<?php

use helpers\Html;
use helpers\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var cms\models\Partners $model */
/** @var helpers\widgets\ActiveForm $form */
?>

<div class="partners-form card shadow-sm mb-3">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Partner Details</h5>
    </div>
    <div class="card-body p-4">
        <?php $form = ActiveForm::begin([
            'options' => ['data-pjax' => true, 'enctype' => 'multipart/form-data'],
        ]); ?>

        <div class="row g-2">
            <!-- Title Field -->
            <div class="col-md-12 mb-3">
                <?= $form->field($model, 'title')
                    ->textInput(['maxlength' => true, 'placeholder' => 'Enter Partner Title', 'class' => 'form-control form-control-sm'])
                    ->label('Title', ['class' => 'form-label']); ?>
            </div>

            <!-- File Upload with Preview -->
            <div class="col-md-12 mb-3">
                <?= $form->field($model, 'file')
                    ->fileInput(['class' => 'form-control form-control-sm', 'id' => 'partner-file-input'])
                    ->label('Upload Partner Logo', ['class' => 'form-label']); ?>
                <img id="partner-preview" src="#" alt="Image Preview" class="img-thumbnail mt-2" style="max-width: 150px; display: none;">
            </div>

            <!-- Publish Status (Checkbox) -->
            <div class="col-md-6 mb-3">
                <?= $form->field($model, 'is_published')->checkbox([
                    'label' => 'Publish',
                    'class' => 'form-check-input',
                ])->label(false); ?>
            </div>
        </div>

        <div class="text-center">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-sm']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<?php
$script = <<<JS
document.getElementById('partner-file-input').addEventListener('change', function (event) {
    const preview = document.getElementById('partner-preview');
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        preview.src = '#';
        preview.style.display = 'none';
    }
});
JS;
$this->registerJs($script);
?>
