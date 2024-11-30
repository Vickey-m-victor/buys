<?php
use helpers\Html;
use helpers\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var cms\models\About $model */
/** @var helpers\widgets\ActiveForm $form */
?>

<div class="about-form card shadow-sm">
    <div class="card-body p-3">
        <h4 class="card-title mb-3 text-center">About Us Information</h4>
        
        <?php $form = ActiveForm::begin([
            'options' => [
                'data-pjax' => true,
                'enctype' => 'multipart/form-data',
                'class' => 'needs-validation'
            ]
        ]); ?>

        <div class="row g-3">
            <div class="col-12">
                <?= $form->field($model, 'title')->textInput([
                    'maxlength' => true,
                    'class' => 'form-control',
                    'placeholder' => 'Enter title'
                ]) ?>
            </div>

            <div class="col-12">
                <?= $form->field($model, 'description')->textarea([
                    'rows' => 4,
                    'class' => 'form-control',
                    'placeholder' => 'Enter description',
                    'style' => 'resize: vertical; min-height: 100px;'
                ]) ?>
            </div>

            <div class="col-md-6">
                <?= $form->field($model, 'file')->fileInput([
                    'class' => 'form-control',
                    'onchange' => 'previewAboutImage(event)',
                    'accept' => 'image/*'
                ])->label('Upload Image') ?>
            </div>
            
            <div class="col-md-6">
                <div class="text-center">
                    <label class="form-label">Image Preview</label>
                    <?php if ($model->imageURL): ?>
                        <img id="about-image-preview" 
                             src="<?= $model->imageURL ?>" 
                             alt="About Image Preview" 
                             class="img-thumbnail"
                             style="max-width: 150px; max-height: 150px; object-fit: cover;">
                    <?php else: ?>
                        <img id="about-image-preview" 
                             src="#" 
                             alt="No Image Selected" 
                             class="img-thumbnail"
                             style="display: none; max-width: 150px; max-height: 150px; object-fit: cover;">
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="text-center mt-3">
            <?= Html::submitButton(
                'Save Changes',
                ['class' => 'btn btn-success px-4']
            ) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
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