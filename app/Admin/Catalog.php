<?php

#use App\Model\Product;
use App\Model\Catalog;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(Catalog::class, function (ModelConfiguration $model) {
    $model->setTitle('Каталог');

    $model->onDisplay(function() {
        $display = AdminDisplay::table()->paginate(10);

        $display->setHtmlAttribute('class', 'table-bordered table-success table-hover');

        $display->setApply(function ($query) {
            $query->orderBy('order', 'asc');
        });

        $display->setColumns([
            AdminColumn::text('id')->setLabel('#')->setWidth('30px'),
            AdminColumn::image('avatar')
                ->setLabel('Аватар')
                ->setHtmlAttribute('class', 'hidden-sm hidden-xs')
                ->setWidth('64px'),
                
            AdminColumn::link('title')->setLabel('Название'),

            AdminColumn::order()
                ->setLabel('Порядок')
                ->setHtmlAttribute('class', 'text-center')
                ->setWidth('100px'),
        ]);

        return $display;
    });

    $model->onCreateAndEdit(function($id = null) {
        $form = AdminForm::form();
        $form->setItems([
            AdminFormElement::text('title', 'Название')->required(),
            AdminFormElement::textarea('description', 'Краткое описание'),
            AdminFormElement::wysiwyg('content', 'Содержимое'),
            AdminFormElement::image('avatar', 'Аватар'),
           AdminFormElement::images('photo', 'Фото'),
        ]);


        return $form;
    });
})
    ->addMenuPage(Catalog::class)
    ->setIcon('fa fa-th-list')
    ->setPriority(0);
