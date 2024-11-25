<?php

use cms\models\Banners;
use yii\helpers\Html;

/** @var yii\web\View $this */

// Fetch active banners
$banners = Banners::find()->where(['is_published' => 1,'is_deleted'=>0])->all(); 
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
