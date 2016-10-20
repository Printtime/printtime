<?php

use App\Model\Product;
use App\Model\Catalog;
use App\Model\Postpress;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(Product::class, function (ModelConfiguration $model) {
    $model->setTitle('Товары')->enableAccessCheck();

    $model->onDisplay(function () {
        $display = AdminDisplay::table()->paginate(30);

        $display->setHtmlAttribute('class', 'table-bordered table-success table-hover');

        $display->setApply(function ($query) {
            $query->orderBy('order_group', 'asc');
        });


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

            AdminColumn::order()
                ->setLabel('Порядок')
                ->setHtmlAttribute('class', 'text-center')
                ->setWidth('100px'),
                
                #php artisan vendor:publish --tag=assets --force

                AdminColumn::lists('postpresss.label')->setLabel('Postpress')->setWidth('100px'),
                AdminColumnEditable::checkbox('order_vis')->setLabel('Duplex')->setWidth('64px'),

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
           AdminFormElement::checkbox('order_vis', 'Возможна двусторонняя печать'),
           // AdminFormElement::text('order_name', 'Название в списке услуг для заказа'),
            AdminFormElement::multiselect('postpresss', 'Postpress')->setModelForOptions(new Postpress())->setDisplay('label'),
        ]);


        return $form;
    });

});
