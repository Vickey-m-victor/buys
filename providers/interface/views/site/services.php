<?php
use cms\models\Services;
use cms\models\Partners;
use cms\models\Banners;
use yii\helpers\Html;

/** @var yii\web\View $this */
$services = Services::find()->where(['is_deleted' => 0, 'is_published' => 1])->all();
$patners = Partners::find()->where(['is_published' => 1,'is_deleted'=>0])->all();
$banners = Banners::find()->where(['is_published' => 1,'is_deleted'=>0])->all();
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
                <h1 class="display-4 text-white animated zoomIn">Services</h1>
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
                <h1 class="display-4 text-white animated zoomIn">Services</h1>
                <a href="" class="h5 text-white">Best</a>
                <i class="far fa-circle text-white px-2"></i>
                <a href="" class="h5 text-white">Buys</a>
            </div>
        </div>
    </div>
<?php endif; ?>

        <div class="container-fluid py-5">
    <div class="container py-5">
        <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
            <h5 class="fw-bold text-primary text-uppercase">Our Services</h5>
            <h1 class="mb-0">Custom IT Solutions for Your Successful Business</h1>
        </div>
        <div class="row g-4">
            <?php if (!empty($services)): ?>
                <?php foreach ($services as $index => $service): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item bg-light rounded-lg shadow-hover p-4 h-100 transition-all" style="background-color: #f0f8ff;">
                            <div class="d-flex flex-column align-items-center">
                                <div class=" mb-4">
                                    <img src="<?= Html::encode($service->imageURL) ?>" alt="Service Image" 
                                         class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover;">
                                </div>
                                <h4 class="mb-3 text-center"><?= Html::encode($service->title) ?></h4>
                                <p class="text-center mb-4"><?= Html::encode($service->description) ?></p>
                          
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <p>No services available at the moment.</p>
                </div>
            <?php endif; ?>
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
