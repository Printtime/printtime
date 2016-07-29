<?php

use App\Role;
use App\Permission;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(Permission::class, function (ModelConfiguration $model) {
    $model->setTitle('Права доступа')->enableAccessCheck();

    // Display
    $model->onDisplay(function () {
        return AdminDisplay::table()->with('roles')
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
                AdminColumn::text('id')->setLabel('#')->setWidth('30px'),
                AdminColumn::link('label')->setLabel('Label'),
                AdminColumn::text('name')->setLabel('Key')->setWidth('200px'),
            ])->paginate(20);
    });

    // Create And Edit
    $model->onCreateAndEdit(function() {
        return AdminForm::panel()->addBody([
            AdminFormElement::text('label', 'Label')->required(),
            AdminFormElement::text('name', 'Key')->required(),
            AdminFormElement::multiselect('roles', 'Roles')->setModelForOptions(new Role())->setDisplay('name'),
        ]);
    });
});
