<?php

use helpers\Html;
use helpers\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var cms\models\Banners $model */

?>

<div class="banners-form card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Banner Details</h5>
    </div>
    <div class="card-body">
        <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data', 'id' => 'banner-form'],
        ]); ?>

        <div class="row g-3">
            <div class="col-md-6">
                <?= $form->field($model, 'title')
                    ->textInput(['maxlength' => true, 'placeholder' => 'Banner Title'])
                    ->label('Title', ['class' => 'form-label']); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'description')
                    ->textarea(['rows' => 2, 'maxlength' => true, 'placeholder' => 'Brief Description'])
                    ->label('Description', ['class' => 'form-label']); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'file')
                    ->fileInput(['id' => 'banner-file-input'])
                    ->label('Upload Banner', ['class' => 'form-label']); ?>
                <img id="banner-preview" src="#" alt="Preview" class="img-thumbnail mt-2" style="max-width: 150px; display: none;">
            </div>
            <div class="col-md-6">
    <?= $form->field($model, 'is_published')->checkbox([
        'label' => 'Publish',
        'class' => 'form-check-input',
    ])->label(true); ?>
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
document.getElementById('banner-file-input').addEventListener('change', function (event) {
    const preview = document.getElementById('banner-preview');
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
