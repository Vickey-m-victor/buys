<?php

use cms\models\Banners;
use yii\helpers\Html;
use cms\models\Faqs;
use cms\models\Services;
use cms\models\Partners;
use cms\models\ContactInfo;
use cms\models\BasicInfo;
/** @var yii\web\View $this */

// Fetch active banners
$banners = Banners::find()->where(['is_published' => 1,'is_deleted'=>0])->all(); 
$faqs = Faqs::find()->where(['is_published' => 1,'is_deleted'=>0])->all();
$services = Services::find()
    ->where(['is_published' => 1, 'is_deleted' => 0])
    ->asArray()
    ->all();
$basicInfo = BasicInfo::findOne(1);
$contactInfo = ContactInfo::findOne(1);

?>

<div class="container-fluid position-relative p-0">
    <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php foreach ($banners as $index => $banner): ?>
                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                    <!-- Adjust image styles for consistent appearance -->
                    <img 
                        class="w-100 banner-image" 
                        src="<?= Html::encode($banner->imageURL) ?>" 
                        alt="<?= Html::encode($banner->title) ?>">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-3 animated slideInDown"><?= Html::encode($banner->title) ?></h5>
                            <h1 class="display-1 text-white mb-md-4 animated zoomIn"><?= Html::encode($banner->description) ?></h1>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Carousel controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<div class="mission-vision-section">
    <div class="container">
        <div class="text-center mb-5 animate-in">
            <h1 class="display-4 mb-4">Shaping the <span class="highlight-text">Future</span></h1>
            <p class="lead">Innovating today for a better tomorrow</p>
        </div>
        <div class="row g-4">
    <!-- Mission Section -->
    <div class="col-md-6">
        <div class="card h-100 animate-in" style="animation-delay: 0.2s">
            <div class="card-body text-center">
                <div class="card-icon">
                    <i class="fas fa-rocket"></i>
                </div>
                <h2 class="card-title mb-4">Our Mission</h2>
                <p class="card-text lead">
                    <?= htmlspecialchars($basicInfo->mission) ?>
                </p>
                <button class="btn btn-outline-primary mt-3" onclick="showMore('mission')">
                    Learn More
                </button>
                <div id="mission-content" class="mt-3" style="display: none;">
                    <p>We strive to:</p>
                    <ul class="list-unstyled">
                        <li>✓ Drive digital transformation</li>
                        <li>✓ Foster innovation</li>
                        <li>✓ Build sustainable solutions</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Vision Section -->
    <div class="col-md-6">
        <div class="card h-100 animate-in" style="animation-delay: 0.4s">
            <div class="card-body text-center">
                <div class="card-icon">
                    <i class="fas fa-eye"></i>
                </div>
                <h2 class="card-title mb-4">Our Vision</h2>
                <p class="card-text lead">
                    <?= htmlspecialchars($basicInfo->vision) ?>
                </p>
                <button class="btn btn-outline-primary mt-3" onclick="showMore('vision')">
                    Learn More
                </button>
                <div id="vision-content" class="mt-3" style="display: none;">
                    <p>We envision:</p>
                    <ul class="list-unstyled">
                        <li>✓ Global technology leadership</li>
                        <li>✓ Sustainable development</li>
                        <li>✓ Inclusive innovation</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
</div>
<!-- Services Start -->
<div class="services-section container-fluid py-5">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <!-- Left Content Section -->
            <div class="col-lg-7 fadeInUp">
                <div class="section-title position-relative pb-3 mb-5">
                    <h5 class="fw-bold text-primary text-uppercase">Services We Provide</h5>
                    <h1 class="mb-0" id="serviceTitle"></h1>
                </div>
                
                <p class="mb-4" id="serviceDescription"></p>
                
                <!-- Contact Box -->
                <div class="contact-box d-flex align-items-center p-4 wow fadeIn" data-wow-delay="0.6s">
                    <div class="icon-circle me-3">
                        <i class="fa fa-phone-alt text-white"></i>
                    </div>
                    <div>
                        <h5 class="mb-2">Call to ask any question</h5>
                        <h4 class="text-primary mb-0">+012 345 6789</h4>
                    </div>
                </div>
            </div>

            <!-- Right Image Section -->
            <div class="col-lg-5" style="min-height: 500px;">
                <div class="image-container">
                    <img id="serviceImage" class="position-absolute w-100 h-100 zoomIn" 
                         src="" 
                         alt="Service Image">
                </div>
            </div>
        </div>
    </div>
</div>


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

    <section class="partners-section">
    <div class="container">
        <div class="mb-5">
            <h2 class="text-center section-title mb-4">Our Trusted Partners</h2>
            <p class=" text-center text-muted">Working with industry leaders to deliver excellence</p>
        </div>
    </div>

    <div class="logos-slider pause-on-hover">
        <div class="gradient-overlay-left"></div>
        <div class="gradient-overlay-right"></div>
        
        <div class="logos-slide">
            <!-- Microsoft -->
            <div class="logo-item">
                <i class="fab fa-microsoft fa-3x text-primary"></i>
                <div class="partner-info">
                    <h6 class="mb-1">Microsoft</h6>
                    <small class="text-muted">Cloud Solutions Partner</small>
                </div>
            </div>

            <!-- GitHub -->
            <div class="logo-item">
                <i class="fab fa-github fa-3x"></i>
                <div class="partner-info">
                    <h6 class="mb-1">GitHub</h6>
                    <small class="text-muted">Development Platform Partner</small>
                </div>
            </div>

            <!-- HP -->
            <div class="logo-item">
                <i class="fas fa-laptop fa-3x text-primary"></i>
                <div class="partner-info">
                    <h6 class="mb-1">HP</h6>
                    <small class="text-muted">Hardware Solutions Partner</small>
                </div>
            </div>

            <!-- AWS -->
            <div class="logo-item">
                <i class="fab fa-aws fa-3x text-warning"></i>
                <div class="partner-info">
                    <h6 class="mb-1">Amazon AWS</h6>
                    <small class="text-muted">Cloud Infrastructure Partner</small>
                </div>
            </div>

            <!-- Google -->
            <div class="logo-item">
                <i class="fab fa-google fa-3x text-danger"></i>
                <div class="partner-info">
                    <h6 class="mb-1">Google</h6>
                    <small class="text-muted">Technology Partner</small>
                </div>
            </div>

            <!-- Intel -->
            <div class="logo-item">
                <i class="fas fa-microchip fa-3x text-primary"></i>
                <div class="partner-info">
                    <h6 class="mb-1">Intel</h6>
                    <small class="text-muted">Hardware Technology Partner</small>
                </div>
            </div>

            <!-- Duplicate set for seamless loop -->
            <div class="logo-item">
                <i class="fab fa-microsoft fa-3x text-primary"></i>
                <div class="partner-info">
                    <h6 class="mb-1">Microsoft</h6>
                    <small class="text-muted">Cloud Solutions Partner</small>
                </div>
            </div>

            <div class="logo-item">
                <i class="fab fa-github fa-3x"></i>
                <div class="partner-info">
                    <h6 class="mb-1">GitHub</h6>
                    <small class="text-muted">Development Platform Partner</small>
                </div>
            </div>
        </div>
    </div>
</section>  

<script>
    // PHP to JavaScript: Convert PHP services array to JS
   
    const services = <?= json_encode($services, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>;
    let currentServiceIndex = 0;

function updateServiceContent() {
    const service = services[currentServiceIndex];
    if (service) {
        document.getElementById('serviceTitle').innerText = service.title;
        document.getElementById('serviceDescription').innerText = service.description;
        document.getElementById('serviceImage').src = service.imageURL;
        currentServiceIndex = (currentServiceIndex + 1) % services.length;
    }
}

// Update content every 5 seconds
setInterval(updateServiceContent, 5000);

// Initialize with the first service
updateServiceContent();

</script>