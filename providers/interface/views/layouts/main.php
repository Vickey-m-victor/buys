<?php
/** @var yii\web\View $this */
/** @var string $content */


use yii\helpers\Html;
use ui\bundles\MainAsset;
use cms\models\BasicInfo;


// Retrieve the basic information from the database
$basicInfo = BasicInfo::findOne(1);

MainAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
<meta charset="<?= Yii::$app->charset ?>">


    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($basicInfo ? $basicInfo->name : Yii::$app->name) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
            <!-- Logo -->
            <a href="<?= $basicInfo ? Html::encode($basicInfo->url) : '#' ?>" class="navbar-brand p-0">
                <?php if ($basicInfo && $basicInfo->logoUrl): ?>
                    <img src="<?= Html::encode($basicInfo->logoUrl) ?>" alt="<?= Html::encode($basicInfo->name) ?>" class="logo-img" style="max-height: 50px;">
                <?php else: ?>
                    <h1 class="m-0"><i class="fa-solid fa-money-check-dollar"></i><?= Yii::$app->name ?></h1>
                <?php endif; ?>
            </a>

            <!-- Navbar Toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>

            <!-- Collapsible Navbar Menu -->
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <?= \helpers\Menuu::load() ?>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <?= $content ?>

    <!-- Footer Section -->
    <div class="container-fluid text-white" style="background: #061429;">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-6">
                    <div class="d-flex align-items-center justify-content-center" style="height: 75px;">
                        <p class="mb-0">&copy; <a class="text-white border-bottom" href="#"><?= Html::encode($basicInfo ? $basicInfo->name : Yii::$app->name) ?></a>. All Rights Reserved.
                        Designed by <a class="text-white border-bottom" href="https://htmlcodex.com"><?= $_ENV['APP_DEVELOPER'] ?></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Back to Top Button -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
