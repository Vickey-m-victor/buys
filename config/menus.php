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
    ['title' => 'Contact', 'icon' => 'phone', 'url' => 'home/contact'],
    ['title'=>'banners','icon'=>'car','url'=>'/cms/banners/index'],
    ['title'=> 'Services','icon'=> 'phone','submenus'=>[
['title'=>'Services','url'=>'/cms/services/index'],


    ]],
    ['title' => 'IAM & Admin', 'icon' => 'shield', 'submenus' => [
        ['title' => 'User Management', 'url' => 'profile/index'],
        ['title' => 'Manage Roles', 'url' => 'role/index'],
        ['title' => 'Manage Permissions', 'url' => 'permission/index'],
        ['title' => 'Manage Rules', 'url' => 'rule/index'],
    ]],
    ['title' => 'Settings', 'icon' => 'cog fa-spin', 'submenus' => [
        ['title' => 'General Settings', 'url' => 'settings/index', 'param' => ['id' => 'general']],
        ['title' => 'Email Settings', 'url' => 'settings/index', 'param' => ['id' => 'email']],
    ]],
    ];

return array_merge($userMenu, (new ConfigWrapper())->load('apiMenus'));
