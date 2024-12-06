<?php
use cms\models\BasicInfo;
use cms\models\About;
use yii\helpers\Html;
use cms\models\Banners;
use cms\models\ContactInfo;


$basicInfo = BasicInfo::findOne(1);
$about = About::findOne(1);
$banners = Banners::find()->where(['is_published' => 1,'is_deleted'=>0])->all();
$contactInfo = ContactInfo::findOne(1);



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
                <h1 class="display-4 text-white animated zoomIn">About</h1>
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
                <h1 class="display-4 text-white animated zoomIn">About</h1>
                <a href="" class="h5 text-white">Best</a>
                <i class="far fa-circle text-white px-2"></i>
                <a href="" class="h5 text-white">Buys</a>
            </div>
        </div>
    </div>
<?php endif; ?>
        
<!-- About Start -->
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-7">
                <div class="section-title position-relative pb-3 mb-5">
                    <h5 class="fw-bold text-primary text-uppercase">About Us</h5>
                    <h1 class="mb-0"><?= htmlspecialchars($about->title, ENT_QUOTES, 'UTF-8') ?></h1>
                </div>
                <p class="mb-4"><?= nl2br(Html::decode($about->description)) ?></p>
                <div class="row g-0 mb-3">
                    <div class="col-sm-6 wow zoomIn" data-wow-delay="0.2s">
                        <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Award Winning</h5>
                        <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Professional Staff</h5>
                    </div>
                    <div class="col-sm-6 wow zoomIn" data-wow-delay="0.4s">
                        <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>24/7 Support</h5>
                        <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Fair Prices</h5>
                    </div>
                </div>
              
       

            </div>
            <div class="col-lg-5" style="min-height: 500px;">
                <div class="position-relative h-100">
                    <img class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.9s" 
                         src="<?= htmlspecialchars($about->imageURL, ENT_QUOTES, 'UTF-8') ?>" 
                         alt="About Us Image" 
                         style="object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->
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