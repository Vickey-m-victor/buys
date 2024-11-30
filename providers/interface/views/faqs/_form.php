<?php

use helpers\Html;
use helpers\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var cms\models\Faqs $model */
/** @var helpers\widgets\ActiveForm $form */
?>

<div class="faqs-form card shadow-sm mb-3">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">FAQ Details</h5>
    </div>
    <div class="card-body p-4">
        <?php $form = ActiveForm::begin([
            'options' => ['data-pjax' => true],
        ]); ?>

        <div class="row g-3">
            <!-- Question Field -->
            <div class="col-md-12">
                <?= $form->field($model, 'question')
                    ->textInput([
                        'maxlength' => true, 
                        'placeholder' => 'Enter FAQ Question', 
                        'class' => 'form-control form-control-sm'
                    ])
                    ->label('Question', ['class' => 'form-label']); ?>
            </div>

            <!-- Answer Field -->
            <div class="col-md-12">
                <?= $form->field($model, 'answer')
                    ->textarea([
                        'rows' => 6, 
                        'placeholder' => 'Provide a detailed answer', 
                        'class' => 'form-control form-control-sm'
                    ])
                    ->label('Answer', ['class' => 'form-label']); ?>
            </div>

            <!-- Publish Status (Checkbox) -->
            <div class="col-md-6">
                <?= $form->field($model, 'is_published')->checkbox([
                    'label' => 'Publish',
                    'class' => 'form-check-input',
                ])->label(false); ?>
            </div>
        </div>

        <div class="text-center mt-4">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-sm px-4']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
