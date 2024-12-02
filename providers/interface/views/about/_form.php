<?php
use helpers\Html;
use helpers\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
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

        <div class="row">
            <!-- Form Fields Column -->
            <div class="col-md-8">
                <div class="row g-3">
                    <div class="col-12">
                        <?= $form->field($model, 'title')->textInput([
                            'maxlength' => true,
                            'class' => 'form-control',
                            'placeholder' => 'Enter title'
                        ]) ?>
                    </div>

                    <div class="col-12">
                        <?= $form->field($model, 'description')->widget(CKEditor::class, [
                        'options' => ['rows' => 2],
                        'preset' => 'basic',
                        'clientOptions' => [
                            'height' => 100,
                       
                        ],
                    ]) ?>
                    </div>

                    <div class="col-12">
                        <?= $form->field($model, 'file')->fileInput([
                            'class' => 'form-control',
                            'onchange' => 'previewAboutImage(event)',
                            'accept' => 'image/*'
                        ])->label('Upload Image') ?>
                    </div>
                </div>
            </div>

            <!-- Image Preview Column -->
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Image Preview</h6>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <?php if ($model->imageURL): ?>
                            <img id="about-image-preview" 
                                 src="<?= $model->imageURL ?>" 
                                 alt="About Image Preview" 
                                 class="img-thumbnail"
                                 style="max-width: 100%; max-height: 200px; object-fit: contain;">
                        <?php else: ?>
                            <img id="about-image-preview" 
                                 src="#" 
                                 alt="No Image Selected" 
                                 class="img-thumbnail"
                                 style="display: none; max-width: 100%; max-height: 200px; object-fit: contain;">
                        <?php endif; ?>
                    </div>
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