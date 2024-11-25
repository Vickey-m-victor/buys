<?php

?>
    <div class="container-fluid position-relative p-0">

     <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="providers/interface/assets/main/img/carousel-1.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-3 animated slideInDown">Creative & Innovative</h5>
                            <h1 class="display-1 text-white mb-md-4 animated zoomIn">Creative & Innovative Digital Solution</h1>
                            <!-- <a href="quote.html" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Free Quote</a> -->
                            <!-- <a href="" class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">Contact Us</a> -->
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="providers/interface/assets/main/img/carousel-2.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-3 animated slideInDown">Creative & Innovative</h5>
                            <h1 class="display-1 text-white mb-md-4 animated zoomIn">Creative & Innovative Digital Solution</h1>
                            <!-- <a href="quote.html" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Free Quote</a> -->
                            <!-- <a href="" class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">Contact Us</a> -->
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
<div class="content-block content-width overflow-auto text-align-justify">
    <div class="margin-bottom-40 overflow-auto">
        <div class="c22 grid-columns">
            <h2>Getting started</h2>
            <p>If you are seeing this then <?= Yii::$app->name ?> is ready to rock. </p>
            <ul class="tabbed-content-list table-li margin-top-20">
                <li><span class="c6 display-table-cell">PHP Version</span> <span class="display-table-cell"><?= PHP_VERSION ?></span></li>
                <li><span class="c6 display-table-cell">Server</span> <span class="display-table-cell"><?= gethostname() . ' ' . PHP_OS . '/' . PHP_SAPI ?></span></li>
                <li><span class="c6 display-table-cell">PDO</span> <span class="display-table-cell"><?= !extension_loaded('PDO') ? 'Disabled' : 'Enabled' ?></span></li>
                <li><span class="c6 display-table-cell">PDO MYSQL</span> <span class="display-table-cell"><?= !extension_loaded('pdo_mysql') ? 'Disabled' : 'Enabled' ?></span></li>
                <li><span class="c6 display-table-cell">PDO PGSQL</span> <span class="display-table-cell"><?= !extension_loaded('pdo_pgsql') ? 'Disabled' : 'Enabled' ?></span></li>
                <li><span class="c6 display-table-cell">Mbstring</span> <span class="display-table-cell"><?= !extension_loaded('mbstring') ? 'Disabled' : 'Enabled' ?></span></li>

            </ul>
        </div>
    </div>
</div>
