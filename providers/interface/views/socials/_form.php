
<?php
use helpers\Html;
use helpers\widgets\ActiveForm;
/** @var yii\web\View $this */
/** @var cms\models\Socials $model */
/** @var helpers\widgets\ActiveForm $form */
?>
<div class="socials-form card">
    <div class="card-body">
        <?php $form = ActiveForm::begin([
            'options' => [
                'data-pjax' => true,
                'class' => 'needs-validation'
            ]
        ]); ?>
        <div class="row g-4">
            <div class="col-12">
                <div class="form-group">
                    <?= $form->field($model, 'platform')
                        ->textInput([
                            'maxlength' => true,
                            'class' => 'form-control form-control-lg',
                            'placeholder' => 'Enter platform name'
                        ])
                        ->label('Platform Name') ?>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <?= $form->field($model, 'icon')
                        ->textInput([
                            'maxlength' => true,
                            'class' => 'form-control form-control-lg',
                            'placeholder' => 'Enter icon class or code'
                        ])
                        ->label('Social Media Icon') ?>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <?= $form->field($model, 'link')
                        ->textInput([
                            'maxlength' => true,
                            'class' => 'form-control form-control-lg',
                            'placeholder' => 'Enter social media link'
                        ])
                        ->label('Social Media Link') ?>
                </div>
            </div>
            <div class="col-12">
                <div class="form-check form-switch">
                    <?= $form->field($model, 'is_published')
                        ->checkbox([
                            'label' => 'Publish',
                            'class' => 'form-check-input',
                            'style' => 'cursor: pointer;'
                        ])
                        ->label(false) ?>
                    <label class="form-check-label" for="socials-is_published">
                        Publish this social media
                    </label>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <?= Html::submitButton(
                'Save Changes',
                [
                    'class' => 'btn btn-success btn-lg px-4',
                    'style' => 'min-width: 200px;'
                ]
            ) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>