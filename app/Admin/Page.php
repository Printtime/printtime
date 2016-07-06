<?php

use App\Model\Page;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(Page::class, function (ModelConfiguration $model) {
    $model->setTitle('Страницы');

    // Display
    $model->onDisplay(function () {
        return AdminDisplay::tree()->setValue('title');
    });

    // Create And Edit
    $model->onCreateAndEdit(function() {
        return AdminForm::form()->setItems([
            AdminFormElement::text('title', 'Title')->required(),
            AdminFormElement::textarea('description', 'Краткое описание'),
           # AdminFormElement::ckeditor('text', 'Содержание')

            AdminFormElement::wysiwyg('text', 'Содержание')
            ->setParameters([
                'height' => 400,
            ])

        ]);
    });
})->addMenuPage(Page::class)->setIcon('fa fa-sitemap');
