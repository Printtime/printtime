<?php

use App\Model\Variable;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(Variable::class, function (ModelConfiguration $model) {
    $model->setTitle('Параметры');

    // Display
    $model->onDisplay(function () {
        #return AdminDisplay::table()->with('types')
        return AdminDisplay::table()
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
                AdminColumn::text('id')->setLabel('#')->setWidth('30px'),
                AdminColumn::order()
                    ->setLabel('Порядок')
                    ->setHtmlAttribute('class', 'text-center')
                    ->setWidth('100px'),
                AdminColumn::link('title')->setLabel('Название'),
                AdminColumn::text('label')->setLabel('Лейбл'),
            ])
            ->setApply(function ($query) {
            $query->orderBy('order', 'asc');
            })
            ->paginate(20);
    });

    // Create And Edit
    $model->onCreateAndEdit(function() {
        return AdminForm::panel()->addBody([
            AdminFormElement::text('title', 'Title')->required(),
            AdminFormElement::text('label', 'Label')
        ]);
    });
});
