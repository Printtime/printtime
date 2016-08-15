<?php

use SleepingOwl\Admin\Navigation\Page;

return [
/*
    [
        'title' => "Contacts",
        'icon' => 'fa fa-credit-card',
        'pages' => [
            (new Page(\App\Model\Contact::class))
                ->setIcon('fa fa-fax')
                ->setPriority(0),
            (new Page(\App\Model\Contact2::class))
                ->setIcon('fa fa-fax')
                ->setPriority(100),
            (new Page(\App\Model\Contact3::class))
                ->setIcon('fa fa-fax')
                ->setPriority(200),
            (new Page(\App\Model\Contact4::class))
                ->setIcon('fa fa-fax')
                ->setPriority(400),
        ]
    ],
    [
        'title' => "Content",
        'icon' => 'fa fa-newspaper-o',
        'pages' => [
            (new Page(\App\Model\News::class))
                ->setIcon('fa fa-newspaper-o')
                ->setPriority(0),
            (new Page(\App\Model\News2::class))
                ->setIcon('fa fa-newspaper-o')
                ->setPriority(10),
            (new Page(\App\Model\News3::class))
                ->setIcon('fa fa-newspaper-o')
                ->setPriority(20),
            (new Page(\App\Model\News4::class))
                ->setIcon('fa fa-newspaper-o')
                ->setPriority(30),
            (new Page(\App\Model\News5::class))
                ->setIcon('fa fa-newspaper-o')
                ->setPriority(40)
        ]
    ],
    */


/*        [
        'title' => "Содержимое",
        'icon' => 'fa fa-newspaper-o',
        'pages' => [
            (new Page(\App\Model\Catalog::class))
                ->setIcon('fa fa-newspaper-o')
                ->setPriority(0),
            (new Page(\App\Model\Product::class))
                ->setIcon('fa fa-newspaper-o')
                ->setPriority(10),
        ]
    ],*/

    [
        'title' => 'Магазин',
        'icon' => 'fa fa-shopping-bag',
        'pages' => [
            (new Page(\App\Model\Catalog::class))
                ->setIcon('fa fa-th-list')
                ->setPriority(0),
            (new Page(\App\Model\Product::class))
                ->setIcon('fa fa-list-alt')
                ->setPriority(10),
            (new Page(\App\Model\Type::class))
                ->setIcon('fa fa-database')
                ->setPriority(20),
            (new Page(\App\Model\Variable::class))
                ->setIcon('fa fa-database')
                ->setPriority(30),
            (new Page(\App\Model\TypeVar::class))
                ->setIcon('fa fa-database')
                ->setPriority(40)
        ]
    ],


    [
        'title' => 'Пользователи',
        'icon' => 'fa fa-group',
        'pages' => [
            (new Page(\App\User::class))
                ->setIcon('fa fa-user')
                ->setPriority(0),
            (new Page(\App\Role::class))
                ->setIcon('fa fa-group')
                ->setPriority(100),
            (new Page(\App\Permission::class))
                ->setIcon('fa fa-sitemap')
                ->setTitle('Права')
                ->setPriority(150)
        ]
    ]
];