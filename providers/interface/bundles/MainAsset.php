<?php

namespace ui\bundles;

use yii\web\AssetBundle;


class MainAsset extends AssetBundle
{
    public $basePath = '@ui/assets';
    public $baseUrl = '@web/providers/interface/assets';
    public $css = [
        [
            'href' => 'oneui/bestbuys.png',
            'rel' => 'icon',
            'sizes' => '64x64',
        ],
        'peafowl/css/theme.css',
        'peafowl/css/style.css',
        'main/lib/owlcarousel/assets/owl.carousel.min.css',
        'main/lib/animate/animate.min.css',
        'main/css/bootstrap.min.css',
        'main/css/style.css',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css',
        'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css',
        // 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css',
    ];
    public $js = [
        'main/lib/wow/wow.min.js',
        'main/lib/easing/easing.min.js',
        'main/lib/waypoints/waypoints.min.js',
        'main/lib/counterup/counterup.min.js',
        'main/lib/owlcarousel/owl.carousel.min.js',
        'main/js/main.js',
        'https://code.jquery.com/jquery-3.4.1.min.js',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}