<?php

use helpers\Html;
use helpers\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var cms\models\Services $model */

?>

<div class="services-form card shadow-sm">
    <div class="card-header bg-secondary text-white">
        <h5 class="mb-0">Service Details</h5>
    </div>
    <div class="card-body">
        <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data', 'id' => 'service-form'],
        ]); ?>

        <div class="row g-3">
            <div class="col-md-6">
                <?= $form->field($model, 'title')
                    ->textInput(['maxlength' => true, 'placeholder' => 'Service Title'])
                    ->label('Title', ['class' => 'form-label']); ?>
            </div>
          
            <div class="col-md-6">
                <?= $form->field($model, 'file')
                    ->fileInput(['id' => 'service-file-input'])
                    ->label('Upload Service Image', ['class' => 'form-label']); ?>
                <img id="service-preview" 
                     src="<?= $model->imageURL ?: '#' ?>" 
                     alt="Preview" 
                     class="img-thumbnail mt-2" 
                     style="max-width: 150px; <?= $model->imageURL ? '' : 'display: none;' ?>">
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'description')
                    ->textarea(['rows' => 2, 'maxlength' => true, 'placeholder' => 'Brief Description'])
                    ->label('Description', ['class' => 'form-label']); ?>
                     <div class="col-md-6">
                <?= $form->field($model, 'is_published')->checkbox([
                    'label' => 'Publish',
                    'class' => 'form-check-input',
                ])->label(true); ?>
            </div>
            </div>
           
        </div>

        <div class="text-center mt-4">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-sm']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<?php
$script = <<<JS
document.getElementById('service-file-input').addEventListener('change', function (event) {
    const preview = document.getElementById('service-preview');
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
