<?php
require_once __DIR__ . '/wrapper.php';
$userMenu = [
    ['title' => 'Dashboard', 'icon' => 'home', 'url'=>''], 
    ['title'=> 'About us', 'icon'=> 'user-pen','url'=> '/cms/about/update?id=1'],
    ['title' => 'Contact', 'icon' => 'phone', 'url' => '/dashboard/home/contact'],
    ['title'=>'banners','icon'=>'flag','url'=>'/cms/banners/index'],
    ['title'=> 'Services','icon'=> 'computer','url'=>'/cms/services/index'],
    ['title'=> 'Partners','icon'=> 'signal','url'=> '/cms/partners/index'],
    ['title'=> 'Faqs','icon'=> 'question','url'=> '/cms/faqs/index'],
     ['title' => 'IAM & Admin', 'icon' => 'shield', 'submenus' => [
        ['title' => 'User Management', 'url' => '/dashboard/profile/index'],
        ['title' => 'Manage Roles', 'url' => '/dashboard/role/index'],
        ['title' => 'Manage Permissions', 'url' => '/dashboard/permission/index'],
        ['title' => 'Manage Rules', 'url' => 'rule/index'],
    ]],
    ['title' => 'Settings', 'icon' => 'cog fa-spin', 'submenus' => [
        ['title' => 'Contact Settings', 'url' => '/cms/contact-info/update?id=1'],
        ['title' => 'Basic Settings', 'url' => '/cms/basic-info/update?id=1'],
        ['title' => 'Socials', 'url'=> '/cms/socials/index']
    ]],
    ['title' => 'BestBuys', 'icon' => 'b', 'url' => '/'],

    ];

// return array_merge($userMenu, (new ConfigWrapper())->load('apiMenus'));
return $userMenu;
