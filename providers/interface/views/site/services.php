<?php 
use cms\models\Services;
use yii\helpers\Html;

/** @var yii\web\View $this */

$services = Services::find()->where(['is_deleted' => 0, 'is_published' => 1])->all();

?>

<div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
            <div class="row py-5">
                <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-4 text-white animated zoomIn">Services</h1>
                    <a href="" class="h5 text-white">Home</a>
                    <i class="far fa-circle text-white px-2"></i>
                    <a href="" class="h5 text-white">Services</a>
                </div>
            </div>
        </div>



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
                                <div class="service-icon mb-4">
                                    <img src="<?= Html::encode($service->imageURL) ?>" alt="Service Image" 
                                         class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover;">
                                </div>
                                <h4 class="mb-3 text-center"><?= Html::encode($service->title) ?></h4>
                                <p class="text-center mb-4"><?= Html::encode($service->description) ?></p>
                                <a class="btn btn-primary rounded-circle d-flex align-items-center justify-content-center" 
                                   style="width: 45px; height: 45px;" href="">
                                    <i class="bi bi-arrow-right"></i>
                                </a>
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
        <div class="text-center mb-5">
            <h2 class="section-title mb-4">Our Trusted Partners</h2>
            <p class="text-muted">Working with industry leaders to deliver excellence</p>
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
