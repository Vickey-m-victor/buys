<?php
require_once __DIR__ . '/wrapper.php';
$userMenu = [
    ['title' => 'Dashboard', 'icon' => 'home', 'submenus'=>[
        
        ['title'=>'Projects','url'=>'projects/index'],
        ['title'=>'Team','url'=>'team/index'],
        ['title'=>'Settings','url'=>'settings'],
        ['title'=>'Basic Info','url'=>'basic-info/index'],
        ['title'=>'Partners','url'=>'partners/index'],
        ['title'=>'Socials','url'=>'socials/index'],
        ['title'=>'About','url'=>'about/index'],
        ['title'=>'Why Us','url'=>'whyus/index'],
        ],
        
    ],
    ['title' => 'Contact', 'icon' => 'phone', 'url' => '/dashboard/home/contact'],
    ['title'=>'banners','icon'=>'flag','url'=>'/cms/banners/index'],
    ['title'=> 'Services','icon'=> 'computer','url'=>'/cms/services/index'],
    ['title'=> 'Partners','icon'=> 'signal','url'=> '/cms/products/index'],
     ['title' => 'IAM & Admin', 'icon' => 'shield', 'submenus' => [
        ['title' => 'User Management', 'url' => '/dashboard/profile/index'],
        ['title' => 'Manage Roles', 'url' => '/dashboard/role/index'],
        ['title' => 'Manage Permissions', 'url' => '/dashboard/permission/index'],
        ['title' => 'Manage Rules', 'url' => 'rule/index'],
    ]],
    ['title' => 'Settings', 'icon' => 'cog fa-spin', 'submenus' => [
        ['title' => 'General Settings', 'url' => '/cms/contact-info/update?id=1'],
        ['title' => 'Email Settings', 'url' => 'settings/index', 'param' => ['id' => 'email']],
    ]],
    ['title' => 'BestBuys', 'icon' => 'b', 'url' => '/'],

    ];

// return array_merge($userMenu, (new ConfigWrapper())->load('apiMenus'));
return $userMenu;
