<?php

use App\Model\Slider;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(Slider::class, function (ModelConfiguration $model) {
    $model->setTitle('Слайдер')->enableAccessCheck();

    $model->onDisplay(function() {
        $display = AdminDisplay::table();

        $display->setHtmlAttribute('class', 'table-hover');

        $display->setApply(function ($query) {
            $query->orderBy('order', 'asc');
        });

        $display->setColumns([

            AdminColumn::text('id')
                ->setLabel('#')
                ->setWidth('30px'),

            AdminColumn::image('slider')->setLabel('Слайд')->setWidth('100px'),

            AdminColumn::link('title')->setLabel('Название'),

            AdminColumn::text('link')->setLabel('Ссылка'),
            // AdminColumn::count('contacts')
            //     ->setLabel('Contacts')
            //     ->setWidth('100px')
            //     ->setHtmlAttribute('class', 'text-center')
            //     ->append(
            //         AdminColumn::filter('country_id')->setModel(new Contact)
            //     ),
            AdminColumn::order()
                ->setLabel('Order')
                ->setHtmlAttribute('class', 'text-center')
                ->setWidth('100px'),
        ]);

        return $display;
    });

    $model->onCreateAndEdit(function($id = null) {
        $form = AdminForm::form();
        $form->setItems([
            AdminFormElement::text('title', 'Title')->required(),
            AdminFormElement::text('link', 'Link')->required(),
            AdminFormElement::image('slider', 'Image'),
        ]);
        return $form;
    });
})
    ->addMenuPage(Slider::class)
    ->setIcon('fa fa-file-image-o');
