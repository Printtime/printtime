<?php

use App\Model\Type;
use App\Model\Variable;
use App\Model\TypeVar;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(TypeVar::class, function (ModelConfiguration $model) {
    $model->setTitle('Связь');

    // Display
    $model->onDisplay(function () {
        #return AdminDisplay::table()->with('types')
        return AdminDisplay::table()
            ->setHtmlAttribute('class', 'table-primary')->with('variable', 'type')
            ->setColumns([
                AdminColumn::text('id')->setLabel('#')->setWidth('30px'),

            AdminColumn::link('type.title')->setLabel('Тип товара'),
            AdminColumn::link('variable.title')->setLabel('Параметры'),

                AdminColumn::text('price')->setLabel('Цена'),
                AdminColumn::text('quantity')->setLabel('Кол-во')->setWidth('200px'),
            ])->paginate(20);
    });

    // Create And Edit
    $model->onCreateAndEdit(function() {
        return AdminForm::panel()->addBody([
            AdminFormElement::select('type_id', 'Тип товара')->setModelForOptions(new Type)->setDisplay('title')->required(),
            AdminFormElement::select('var_id', 'Параметры')->setModelForOptions(new Variable)->setDisplay('title')->required(),
            AdminFormElement::text('price', 'price')->required(),
            AdminFormElement::text('quantity', 'quantity')->required()
        ]);
    });
});
