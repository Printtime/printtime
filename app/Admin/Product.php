<?php

use App\Model\Product;
use App\Model\Catalog;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(Product::class, function (ModelConfiguration $model) {
    $model->setTitle('Товары');
    #$model->setTitle('Products')->enableAccessCheck();
    $model->onDisplay(function () {
        $display = AdminDisplay::table()->paginate(30);

        $display->setHtmlAttribute('class', 'table-bordered table-success table-hover');

     $display->with('catalog');
        $display->setFilters([
            AdminDisplayFilter::related('catalog_id')->setModel(Catalog::class),
            AdminDisplayFilter::field('catalog.title')->setOperator(\SleepingOwl\Admin\Display\Filter\FilterBase::CONTAINS)
        ]);

/*        $display->with('country', 'companies', 'author');
        $display->setFilters([
            AdminDisplayFilter::related('country_id')->setModel(Country::class)
        ]);*/

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
        ]);
        

/*        $display->setColumns([
            $photo = AdminColumn::image('avatar')
                ->setLabel('avatar<br/><small>(image)</small>')
                ->setHtmlAttribute('class', 'hidden-sm hidden-xs')
                ->setWidth('100px'),*/
           /*
            AdminColumn::link('fullName')
                ->setLabel('Name<br/><small>(string with accessor)</small>')
                ->setWidth('200px'),
            AdminColumn::datetime('birthday')
                ->setLabel('Birthday<br/><small>(datetime)</small>')
                ->setWidth('150px')
                ->setHtmlAttribute('class', 'text-center')
                ->setFormat('d.m.Y'),
                */

/*            $country = AdminColumn::text('country.title')
                ->setLabel('Country<br/><small>(string from related model)</small>')
                ->setHtmlAttribute('class', 'hidden-sm hidden-xs hidden-md')
                ->append(
                    AdminColumn::filter('country_id')
                ),*/

                /*
             AdminColumn::relatedLink('author.name')
                ->setLabel('Author'),
                
            $companiesCount = AdminColumn::count('companies')
                ->setLabel('Companies<br/><small>(count)</small>')
                ->setHtmlAttribute('class', 'text-center hidden-sm hidden-xs')
                ->setWidth('50px'),
            $companies = AdminColumn::lists('companies.title')
                ->setLabel('Companies<br/><small>(lists)</small>')
                ->setHtmlAttribute('class', 'hidden-sm hidden-xs hidden-md'),
            AdminColumn::custom()->setLabel('Has Photo?<br/><small>(custom)</small>')->setCallback(function ($instance) {
                return $instance->photo ? '<i class="fa fa-check"></i>' : '<i class="fa fa-minus"></i>';
            })
                ->setHtmlAttribute('class', 'text-center')
                ->setWidth('50px'),
                
                ]  );
                */
      

        // $photo->getHeader()->setHtmlAttribute('class', 'hidden-sm hidden-xs');
       # $country->getHeader()->setHtmlAttribute('class', 'hidden-sm hidden-xs hidden-md');
       # $companies->getHeader()->setHtmlAttribute('class', 'hidden-sm hidden-xs hidden-md');
       # $companiesCount->getHeader()->setHtmlAttribute('class', 'hidden-sm hidden-xs');

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
        ]);


        return $form;
    });

    // Create And Edit
//     $model->onCreateAndEdit(function($id = null) {
//         $form = AdminForm::panel();


//         $form->setItems(
//             AdminFormElement::columns()
//                 ->addColumn(function() {
//                     return [
//                         AdminFormElement::text('title', 'title')->required('Please, type title'),
//                         AdminFormElement::text('description', 'description')->required(),
//                         AdminFormElement::text('content', 'content'),
//                     ];
//                 })->addColumn(function() {
//                     return [
//                         AdminFormElement::image('avatar', 'avatar'),
//                         #AdminFormElement::date('birthday', 'Birthday')->setFormat('d.m.Y'),
//                         #AdminFormElement::hidden('user_id')->setDefaultValue(auth()->user()->id),
//                     ];
//                 })
//         );

//         $form
//             ->getButtons()
//             ->setSaveButtonText('Save product')
//             ->hideCancelButton();


//         return $form;

// });
})
    ->addMenuPage(Product::class)
    ->setIcon('fa fa-list-alt')
    ->setPriority(10);

