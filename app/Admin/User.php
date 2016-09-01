<?php

use App\Role;
use App\User;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(User::class, function (ModelConfiguration $model) {
    $model->setTitle('Users')->enableAccessCheck();

    // Display
    $model->onDisplay(function () {
        return AdminDisplay::table()
            ->with('roles')
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
                AdminColumn::image('avatar')->setLabel('Аватар')->setWidth('64px'),
                AdminColumn::link('name')->setLabel('Имя'),
                AdminColumn::text('balance')->setLabel('Баланс'),
                AdminColumn::text('discount', 'Скидка %'),
                AdminColumn::email('email')->setLabel('Email')->setWidth('150px'),
                AdminColumn::lists('roles.label')->setLabel('Roles')->setWidth('200px'),
            ])->paginate(20);
    });

    // Create And Edit
    $model->onCreateAndEdit(function() {
        return AdminForm::panel()->addBody([
            AdminFormElement::text('name', 'Username')->required(),
            AdminFormElement::password('password', 'Password')->required()->addValidationRule('min:6'),
            AdminFormElement::text('email', 'E-mail')->required()->addValidationRule('email'),
            AdminFormElement::multiselect('roles', 'Roles')->setModelForOptions(new Role())->setDisplay('label'),
            AdminFormElement::text('balance', 'Баланс (грн.)'),
            AdminFormElement::text('discount', 'Скидка (%)'),
            #AdminFormElement::multiselect('roles', 'Roles')->lists(Role::class)->setDisplay('label'),
            #AdminFormElement::multiselect('roles', 'Roles', Role::filteredList())->setDisplay('label'),
            #AdminFormElement::multiselect('roles', 'Roles')->setModelForOptions(Role::filteredList())->setDisplay('label'),
            #AdminFormElement::multiselect('roles', 'Roles')->setModelForOptions(User::find(1))->setDisplay('name'),
            #AdminFormElement::multiselect('roles', 'Roles')->setModelForOptions(new Role())->setDisplay('label')->setReadonly(1),
           # AdminFormElement::multiselect('roles', 'Roles')->setModelForOptions(Role::filteredList())->setDisplay('label'),
            #AdminFormElement::multiselect('roles', 'Roles', Role::filteredList())->setDisplay('label'),
            AdminFormElement::upload('avatar', 'Avatar')->addValidationRule('image'),
            AdminColumn::image('avatar')->setWidth('150px'),
        ]);
    });
});
