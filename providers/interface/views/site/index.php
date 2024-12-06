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
$patners = Partners::find()->where(['is_published' => 1,'is_deleted'=>0])->all();
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
<?php
// Helper functions at the top of the file
function extractStrongText($html) {
    preg_match('/<strong>(.*?)<\/strong>/', $html, $matches);
    return $matches[1] ?? '';
}

function extractParagraphText($html) {
    // Remove strong tags and their content
    $text = preg_replace('/<p><strong>.*?<\/strong>.*?<\/p>/', '', $html);
    // Keep remaining p tags
    return strip_tags($text, '<p>');
}
?>

<div class="mission-vision-section">
    <div class="container">
        <div class="text-center mb-5 animate-in">
            <h1 class="display-4 mb-4">Shaping the <span class="highlight-text">Future</span></h1>
            <p class="lead">Innovating today for a better tomorrow</p>
        </div>
        <div class="row g-4">
            <!-- Mission Section -->
            <div class="col-md-4">
    <div class="card h-100 animate-in" style="animation-delay: 0.2s">
        <div class="card-body text-center">
            <div class="card-icon">
                <i class="fas fa-rocket"></i>
            </div>
            <h2 class="card-title mb-4">Our Mission</h2>
            <p class="card-text lead">
                <?= htmlspecialchars(extractStrongText($basicInfo->mission)) ?>
            </p>
            <button class="btn btn-outline-primary mt-3" onclick="showMore('mission')">
                Learn More
            </button>
            <div id="mission-content" class="mt-3" style="display: none;">
                <?= extractParagraphText($basicInfo->mission) ?>
            </div>
        </div>
    </div>
</div>

<!-- Vision Section -->
<div class="col-md-4">
    <div class="card h-100 animate-in" style="animation-delay: 0.4s">
        <div class="card-body text-center">
            <div class="card-icon">
                <i class="fas fa-eye"></i>
            </div>
            <h2 class="card-title mb-4">Our Vision</h2>
            <p class="card-text lead">
                <?= htmlspecialchars(extractStrongText($basicInfo->vision)) ?>
            </p>
            <button class="btn btn-outline-primary mt-3" onclick="showMore('vision')">
                Learn More
            </button>
            <div id="vision-content" class="mt-3" style="display: none;">
                <?= extractParagraphText($basicInfo->vision) ?>
            </div>
        </div>
    </div>
</div>

<!-- Core Values Section -->
<div class="col-md-4">
    <div class="card h-100 animate-in" style="animation-delay: 0.6s">
        <div class="card-body text-center">
            <div class="card-icon">
                <i class="fas fa-star"></i>
            </div>
            <h2 class="card-title mb-4">Core Values</h2>
            <p class="card-text lead">
                <?= htmlspecialchars(extractStrongText($basicInfo->core_values)) ?>
            </p>
            <button class="btn btn-outline-primary mt-3" onclick="showMore('values')">
                Learn More
            </button>
            <div id="values-content" class="mt-3" style="display: none;">
                <?= extractParagraphText($basicInfo->core_values) ?>
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
                        <h4 class="text-primary mb-0"><?= htmlspecialchars($contactInfo->phone, ENT_QUOTES, 'UTF-8') ?></h4>
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



<section class="partners-section">
    <div class="container">
        <div class="mb-5">
            <h2 class="text-center section-title mb-4">Our Trusted Partners</h2>
            <p class="text-center text-muted">Working with industry leaders to deliver excellence</p>
        </div>
    </div>

    <div class="logos-slider pause-on-hover">
        <div class="gradient-overlay-left"></div>
        <div class="gradient-overlay-right"></div>
        
        <div class="logos-slide">
            <?php foreach ($patners as $partner): ?>
                <div class="logo-item">
                    <img src="<?= Html::encode($partner->imageURL) ?>" alt="<?= Html::encode($partner->title) ?>" class="partner-logo">
                    <div class="partner-info">
                        <h6 class="mb-1"><?= Html::encode($partner->title) ?></h6>
                        <!-- Add a subtitle or description here if available -->
                        <small class="text-muted">Trusted Partner</small>
                    </div>
                </div>
            <?php endforeach; ?>
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
            // Ensure only plain text is displayed
            document.getElementById('serviceTitle').innerText = service.title;
            document.getElementById('serviceDescription').innerText = stripHTML(service.description);
            document.getElementById('serviceImage').src = service.imageURL;
            currentServiceIndex = (currentServiceIndex + 1) % services.length;
        }
    }

    // Utility function to strip HTML tags
    function stripHTML(input) {
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = input;
        return tempDiv.textContent || tempDiv.innerText || '';
    }

    // Update content every 5 seconds
    setInterval(updateServiceContent, 5000);

    // Initialize with the first service
    updateServiceContent();
</script>
