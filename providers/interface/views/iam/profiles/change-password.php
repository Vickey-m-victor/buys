<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="card mx-auto" style="max-width: 400px;">
    <div class="card-body">
        <h5 class="card-title mb-3">Change Password</h5>
        
        <?php $form = ActiveForm::begin([
            'id' => 'change-password-form',
            'action' => ['/dashboard/profile/change-password'],
            'enableAjaxValidation' => true,
        ]); ?>

        <?= $form->field($model, 'currentPassword', [
            'options' => ['class' => 'form-group mb-3'],
            'template' => "{label}\n{input}\n{error}",
            'inputOptions' => ['class' => 'form-control']
        ])->passwordInput()->label('Current Password') ?>

        <?= $form->field($model, 'newPassword', [
            'options' => ['class' => 'form-group mb-3'],
            'template' => "{label}\n{input}\n{error}",
            'inputOptions' => ['class' => 'form-control']
        ])->passwordInput()->label('New Password') ?>

        <?= $form->field($model, 'confirmPassword', [
            'options' => ['class' => 'form-group mb-3'],
            'template' => "{label}\n{input}\n{error}",
            'inputOptions' => ['class' => 'form-control']
        ])->passwordInput()->label('Confirm Password') ?>

        <?= Html::submitButton('Update Password', [
            'class' => 'btn btn-secondary w-100'
        ]) ?>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<?php
$script = <<<JS
    $('#change-password-form').on('beforeSubmit', function(e) {
        e.preventDefault();
        var form = $(this);
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                if (response.success) {
                    form[0].reset();
                    alert(response.message);
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                alert('An error occurred while processing your request.');
            }
        });
        return false;
    });
JS;
$this->registerJs($script);
?>