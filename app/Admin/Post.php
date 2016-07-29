<?php

use App\Model\Post;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(Post::class, function (ModelConfiguration $model) {

    $model->setTitle('Новости')->enableAccessCheck();

    // Display
    $model->onDisplay(function () {

        $display = AdminDisplay::table()->paginate(30);
        $display->setHtmlAttribute('class', 'table-bordered table-success table-hover');

        $display->setColumns([

            AdminColumn::image('avatar')
                ->setLabel('Аватар')
                ->setHtmlAttribute('class', 'hidden-sm hidden-xs')
                ->setWidth('64px'),
                
            AdminColumn::link('title')->setLabel('Название'),
            
        ]);

        $display->setColumns([
            AdminColumn::text('created_at')->setLabel('Дата и время')->setWidth('160px'),
        ]);

        return $display;

        /*
        return AdminDisplay::table()->setColumns([
            AdminColumn::link('title')->setLabel('Title'),
        ])->paginate(30);
        */

    });



    // Create And Edit
    $model->onCreateAndEdit(function() {
        return AdminForm::form()->setItems([
            AdminFormElement::text('title', 'Название')->required(),
            AdminFormElement::textarea('description', 'Краткое описание'),
            AdminFormElement::wysiwyg('text', 'Содержание')->required(),
            AdminFormElement::image('avatar', 'Аватар'),
           AdminFormElement::images('photo', 'Фото'),
        ]);
    });
})  
    ->addMenuPage(Post::class)
    ->setIcon('fa fa-newspaper-o')
    ->setPriority(30);
