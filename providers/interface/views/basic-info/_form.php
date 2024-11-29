<?php

use helpers\Html;
use helpers\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var cms\models\BasicInfo $model */
/** @var helpers\widgets\ActiveForm $form */
?>

<div class="basic-info-form card shadow-sm mb-3">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Basic Information</h5>
    </div>
    <div class="card-body p-4">
        <?php $form = ActiveForm::begin([
            'options' => ['data-pjax' => true, 'enctype' => 'multipart/form-data'],
        ]); ?>

        <div class="row g-3">
            <!-- Name Field -->
            <div class="col-md-12">
                <?= $form->field($model, 'name')
                    ->textInput([
                        'maxlength' => true, 
                        'placeholder' => 'Enter Name', 
                        'class' => 'form-control form-control-sm',
                    ])
                    ->label('Name', ['class' => 'form-label']); ?>
            </div>

            <!-- File Upload with Preview -->
            <div class="col-md-12">
                <?= $form->field($model, 'file')
                    ->fileInput([
                        'onchange' => 'previewImage(event)',
                        'class' => 'form-control form-control-sm',
                    ])
                    ->label('Upload Logo', ['class' => 'form-label']); ?>
            </div>
            <div class="col-md-12 mb-3">
                <label class="form-label">Logo Preview:</label>
                <div>
                    <?php if ($model->logoUrl): ?>
                        <img id="logo-preview" src="<?= $model->logoUrl ?>" alt="Logo Preview" class="img-thumbnail" style="max-width: 150px; max-height: 150px;">
                    <?php else: ?>
                        <img id="logo-preview" src="#" alt="No Logo Selected" class="img-thumbnail" style="display: none; max-width: 150px; max-height: 150px;">
                    <?php endif; ?>
                </div>
            </div>

            <!-- URL Field -->
            <div class="col-md-12">
                <?= $form->field($model, 'url')
                    ->textInput([
                        'maxlength' => true, 
                        'placeholder' => 'Enter Website URL', 
                        'class' => 'form-control form-control-sm',
                    ])
                    ->label('Website URL', ['class' => 'form-label']); ?>
            </div>

            <!-- Mission Field -->
            <div class="col-md-12">
                <?= $form->field($model, 'mission')
                    ->textInput([
                        'maxlength' => true, 
                        'placeholder' => 'Enter Mission', 
                        'class' => 'form-control form-control-sm',
                    ])
                    ->label('Mission', ['class' => 'form-label']); ?>
            </div>

            <!-- Vision Field -->
            <div class="col-md-12">
                <?= $form->field($model, 'vision')
                    ->textInput([
                        'maxlength' => true, 
                        'placeholder' => 'Enter Vision', 
                        'class' => 'form-control form-control-sm',
                    ])
                    ->label('Vision', ['class' => 'form-label']); ?>
            </div>
        </div>

        <!-- Save Button -->
        <div class="text-center mt-4">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-sm px-4']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
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
        preview.src = '#';
        preview.style.display = 'none';
    }
}
</script>
