<?php

use cms\models\ContactInfo;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use cms\models\Banners;
use cms\models\Faqs;


/* @var $this yii\web\View */
/* @var $model mail\models\static\ContactForm */

$contactInfo = ContactInfo::findOne(1);
$banners = Banners::find()->where(['is_published' => 1,'is_deleted'=>0])->all();
$faqs = Faqs::find()->where(['is_published' => 1,'is_deleted'=>0])->all();

?>


<?php if (!empty($banners)): ?>
    <?php 
    // Assuming the first active banner is used for the background image
    $banner = $banners[0]; 
    ?>
    <div class="container-fluid bg-primary py-5"
    style="background: linear-gradient(rgba(9, 30, 62, .7), rgba(9, 30, 62, .7)), url(<?= Html::encode($banner->imageURL); ?>) center center no-repeat; background-size: cover; margin-bottom: 90px;">
        <div class="row py-5">
            <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-4 text-white animated zoomIn">FAQs</h1>
                <a href="" class="h5 text-white">Best</a>
                <i class="far fa-circle text-white px-2"></i>
                <a href="" class="h5 text-white">Buys</a>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="container-fluid bg-primary py-5"
    style="background: linear-gradient(rgba(9, 30, 62, .7), rgba(9, 30, 62, .7)), url(../img/carousel-1.jpg) center center no-repeat; background-size: cover; margin-bottom: 90px;">
        <div class="row py-5">
            <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-4 text-white animated zoomIn">FAQs</h1>
                <a href="" class="h5 text-white">Home</a>
                <i class="far fa-circle text-white px-2"></i>
                <a href="" class="h5 text-white">Contact</a>
            </div>
        </div>
    </div>
<?php endif; ?>
<div class="container">
    <!-- Header Section -->
    <div class="text-center mb-5 fade-in">
        <h2 class="faq-title display-5 mb-4">Frequently Asked Questions</h2>
        <p class="text-muted">Find answers to common questions about our services and solutions</p>
    </div>

    <!-- Search Box -->
    <div class="search-box fade-in">
        <i class="fas fa-search search-icon"></i>
        <input type="text" class="form-control" placeholder="Search frequently asked questions..." id="faqSearch">
    </div>

    <!-- FAQ Accordion -->
    <div class="accordion fade-in" id="faqAccordion">
        <?php foreach ($faqs as $faq): ?>
            <div class="accordion-item" data-category="general">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq<?= $faq->id ?>">
                        <?= htmlspecialchars($faq->question) ?>
                    </button>
                </h2>
                <div id="faq<?= $faq->id ?>" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        <?= htmlspecialchars($faq->answer) ?>
                        <div class="feedback-buttons mt-3">
                            <button class="feedback-btn btn btn-outline-success btn-sm">
                                <i class="fas fa-thumbs-up me-2"></i>Helpful
                            </button>
                            <button class="feedback-btn btn btn-outline-danger btn-sm">
                                <i class="fas fa-thumbs-down me-2"></i>Not Helpful
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>