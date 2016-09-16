<?php

use App\Model\Product;
use App\Model\Catalog;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(Product::class, function (ModelConfiguration $model) {
    $model->setTitle('Товары')->enableAccessCheck();

    $model->onDisplay(function () {
        $display = AdminDisplay::table()->paginate(30);

        $display->setHtmlAttribute('class', 'table-bordered table-success table-hover');

     $display->with('catalog');
        $display->setFilters([
            AdminDisplayFilter::related('catalog_id')->setModel(Catalog::class),
            AdminDisplayFilter::field('catalog.title')->setOperator(\SleepingOwl\Admin\Display\Filter\FilterBase::CONTAINS)
        ]);


        $display->setColumns([
            AdminColumn::text('id')->setLabel('#')->setWidth('30px'),
        ]);


        $display->setColumns([

            AdminColumn::image('avatar')
                ->setLabel('Аватар')
                ->setHtmlAttribute('class', 'hidden-sm hidden-xs')
                ->setWidth('64px'),
                
            AdminColumn::link('title')->setLabel('Название'),
            
            AdminColumn::text('catalog.title')
                ->setLabel('Каталог')
                ->setHtmlAttribute('class', 'hidden-sm hidden-xs hidden-md')
                ->append(
                    AdminColumn::filter('catalog_id')
                ),
                
                #php artisan vendor:publish --tag=assets --force
                AdminColumnEditable::checkbox('order_vis')->setLabel('Published'),

        ]);
        

        return $display;
    });

    $model->onCreateAndEdit(function($id = null) {
        $form = AdminForm::form();
        $form->setItems([
            AdminFormElement::text('title', 'Название')->required(),
           AdminFormElement::select('catalog_id', 'Категория каталога')->setModelForOptions(new Catalog)->setDisplay('title'),
            AdminFormElement::textarea('description', 'Краткое описание'),
            AdminFormElement::wysiwyg('content', 'Содержимое'),
            AdminFormElement::image('avatar', 'Аватар'),
           AdminFormElement::images('photo', 'Фото'),
           AdminFormElement::checkbox('order_vis', 'Отображать списке услуг для заказа'),
            AdminFormElement::text('order_name', 'Название в списке услуг для заказа'),
        ]);


        return $form;
    });

});
