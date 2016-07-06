<?php

// PackageManager::load('admin-default')
//    ->css('extend', resources_url('css/extend.css'));

#AdminFormElement::register('dfms', \App\Items\Dfms::class);

#AliasesServiceProvider::register()->registerFormElements('demfile', \App\Admin\DemFile::class);
#AliasesServiceProvider::register()->registerFormElements()->alias(['demfile' => \App\Admin\DemFile::class]);
