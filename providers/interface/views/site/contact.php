<?php

use cms\models\ContactInfo;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model mail\models\static\ContactForm */

$contactInfo = ContactInfo::findOne(1);
?>

<div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
    <div class="row py-5">
        <div class="col-12 pt-lg-5 mt-lg-5 text-center">
            <h1 class="display-4 text-white animated zoomIn">Contact Us</h1>
            <a href="" class="h5 text-white">Home</a>
            <i class="far fa-circle text-white px-2"></i>
            <a href="" class="h5 text-white">Contact</a>
        </div>
    </div>
</div>

<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
            <h5 class="fw-bold text-primary text-uppercase">Contact Us</h5>
            <h1 class="mb-0">If You Have Any Query, Feel Free To Contact Us</h1>
        </div>
        <div class="row g-5 mb-5">
                <div class="col-lg-4">
                    <div class="d-flex align-items-center wow fadeIn" data-wow-delay="0.1s">
                        <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                            <i class="fa fa-phone-alt text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="mb-2">Call to ask any question</h5>
                            <h4 class="text-primary mb-0"><?= htmlspecialchars($contactInfo->phone, ENT_QUOTES, 'UTF-8') ?></h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="d-flex align-items-center wow fadeIn" data-wow-delay="0.4s">
                        <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                            <i class="fa fa-envelope-open text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="mb-2">Email to get free quote</h5>
                            <h4 class="text-primary mb-0"><?= htmlspecialchars($contactInfo->email, ENT_QUOTES, 'UTF-8') ?></h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="d-flex align-items-center wow fadeIn" data-wow-delay="0.8s">
                        <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                            <i class="fa fa-map-marker-alt text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="mb-2">Visit our office</h5>
                            <h4 class="text-primary mb-0"><?= htmlspecialchars($contactInfo->address, ENT_QUOTES, 'UTF-8') ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>
            <div class="alert alert-success">
                Thank you for contacting us. We will respond to you as soon as possible.
            </div>

            <p>
                Note that if you turn on the Yii debugger, you should be able
                to view the mail message on the mail panel of the debugger.
                <?php if (Yii::$app->mailer->useFileTransport): ?>
                    Because the application is in development mode, the email is not sent but saved as
                    a file under <code><?= Yii::getAlias(Yii::$app->mailer->fileTransportPath) ?></code>.
                    Please configure the <code>useFileTransport</code> property of the <code>mail</code>
                    application component to be false to enable email sending.
                <?php endif; ?>
            </p>
        <?php else: ?>
            <?php if (Yii::$app->session->hasFlash('success')): ?>
                <div class="alert alert-success">
                    <?= Yii::$app->session->getFlash('success') ?>
                </div>
            <?php elseif (Yii::$app->session->hasFlash('error')): ?>
                <div class="alert alert-danger">
                    <?= Yii::$app->session->getFlash('error') ?>
                </div>
            <?php endif; ?>

            <div class="row g-5">
                <div class="col-lg-6 wow slideInUp" data-wow-delay="0.3s">
                    <?php $form = ActiveForm::begin([
                        'method' => 'post',
                        'action' => ['site/contact'],  // Corrected the action
                    ]); ?>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <?= $form->field($model, 'name')->textInput([
                                'class' => 'form-control border-0 bg-light px-4', 
                                'placeholder' => 'Your Name', 
                                'style' => 'height: 55px;',
                                'aria-label' => 'Your Name'
                            ])->label(false) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'email')->textInput([
                                'class' => 'form-control border-0 bg-light px-4', 
                                'placeholder' => 'Your Email', 
                                'style' => 'height: 55px;',
                                'aria-label' => 'Your Email'
                            ])->label(false) ?>
                        </div>
                        <div class="col-12">
                            <?= $form->field($model, 'subject')->textInput([
                                'class' => 'form-control border-0 bg-light px-4', 
                                'placeholder' => 'Subject', 
                                'style' => 'height: 55px;',
                                'aria-label' => 'Subject'
                            ])->label(false) ?>
                        </div>
                        <div class="col-12">
                            <?= $form->field($model, 'body')->textarea([
                                'class' => 'form-control border-0 bg-light px-4 py-3', 
                                'rows' => 4, 
                                'placeholder' => 'Message',
                                'aria-label' => 'Message'
                            ])->label(false) ?>
                        </div>
                        <div class="col-12">
                            <?= Html::submitButton('Send Message', [
                                'class' => 'btn btn-primary w-100 py-3'
                            ]) ?>
                        </div>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>

                <div class="col-lg-6 wow slideInUp" data-wow-delay="0.6s">
                    <iframe class="position-relative rounded w-100 h-100"
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7977.626694672816!2d36.82321900000001!3d-1.2860190000000002!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f10d7ba930bb3%3A0xed9c2c436a673d50!2sTransnational%20Plaza%2C%20Wabera%20Ln%2C%20Nairobi%2C%20Kenya!5e0!3m2!1sen!2sus!4v1732970422686!5m2!1sen!2sus"></iframe>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>