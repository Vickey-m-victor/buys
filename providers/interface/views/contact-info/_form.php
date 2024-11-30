<?php

use helpers\Html;
use helpers\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var cms\models\ContactInfo $model */
/** @var helpers\widgets\ActiveForm $form */
?>

<div class="contact-info-form card shadow-sm mb-3">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Contact Information</h5>
    </div>
    <div class="card-body p-4">
        <?php $form = ActiveForm::begin([
            'options' => ['data-pjax' => true],
        ]); ?>

        <div class="row g-3">
            <!-- Address Field -->
            <div class="col-md-12">
                <?= $form->field($model, 'address')
                    ->textInput([
                        'maxlength' => true, 
                        'placeholder' => 'Enter Address', 
                        'class' => 'form-control form-control-sm',
                    ])
                    ->label('Address', ['class' => 'form-label']); ?>
            </div>

            <!-- Phone Field -->
            <div class="col-md-12">
                <?= $form->field($model, 'phone')
                    ->textInput([
                        'maxlength' => true, 
                        'placeholder' => 'Enter Phone Number', 
                        'class' => 'form-control form-control-sm',
                    ])
                    ->label('Phone', ['class' => 'form-label']); ?>
            </div>

            <!-- Email Field -->
            <div class="col-md-12">
                <?= $form->field($model, 'email')
                    ->textInput([
                        'maxlength' => true, 
                        'placeholder' => 'Enter Email Address', 
                        'class' => 'form-control form-control-sm',
                    ])
                    ->label('Email', ['class' => 'form-label']); ?>
            </div>
        </div>

        <!-- Save Button -->
        <div class="text-center mt-4">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-sm px-4']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
