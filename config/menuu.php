<?php
require_once __DIR__ . '/wrapper.php';
$userMenu = [
    ['title' => 'Home', 'icon' => '', 'url' => '/'],
    ['title' => 'About', 'icon' => '', 'url' => 'site/abouts'],
    ['title' => 'Services', 'icon' => '', 'url' => 'site/services'],
    ['title' => 'Contact', 'icon' => '', 'url' => 'site/contact'],
    ['title' => 'Admin', 'icon' => 'user', 'url' => '/dashboard'],
    // ['title' => 'Contact', 'icon' => 'Services', 'url' => 'home/contact'],

];
return array_merge($userMenu);
