<?php

use App\Model\Type;
#use App\Model\Variable;
use App\Model\Product;
#use App\Model\TypeVar;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(Type::class, function (ModelConfiguration $model) {
    $model->setTitle('Виды товаров');

    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::table()->paginate(30);

        $display->setHtmlAttribute('class', 'table-bordered table-success table-hover');

     $display->with('product');
        // $display->setFilters([
        //     AdminDisplayFilter::related('product_id')->setModel(Product::class),
        //     AdminDisplayFilter::field('product.title')->setOperator(\SleepingOwl\Admin\Display\Filter\FilterBase::CONTAINS)
        // ]);


        $display->setColumns([
            AdminColumn::text('id')->setLabel('#')->setWidth('30px'),
        ]);

        $display->setColumns([

            AdminColumn::link('title')->setLabel('Название'),
            
            AdminColumn::text('product.title')
                ->setLabel('Продукт')
                ->setHtmlAttribute('class', 'hidden-sm hidden-xs hidden-md')
                ->append(
                    AdminColumn::filter('product_id')
                ),

            // AdminColumn::lists('type_var.price')
            //     ->setLabel('Type_Var'),
        ]);
        
        return $display;
    });

    // Create And Edit
    // $model->onCreateAndEdit(function($id = null) {
    //     $form = AdminForm::form();
    //     $form->setItems([
    //         AdminFormElement::text('title', 'Название')->required(),
    //        AdminFormElement::select('product_id', 'Продукт')->setModelForOptions(new Product)->setDisplay('title'),
    //         AdminFormElement::text('width', 'Ширина (мм)')->required()->setDefaultValue('1000'),
    //         AdminFormElement::text('height', 'Высота (мм)')->required()->setDefaultValue('1000'),
    //     ]);


    //     return $form;
    // });



    // Create And Edit
    $model->onCreateAndEdit(function($id = null) {
        $display = AdminDisplay::tabbed();
        $display->setTabs(function() use ($id) {
            $tabs = [];

        $form = AdminForm::form();
        $form->setItems([
            AdminFormElement::text('title', 'Название')->required(),
           AdminFormElement::select('product_id', 'Продукт')->setModelForOptions(new Product)->setDisplay('title'),
            AdminFormElement::text('width', 'Ширина (мм)')->required()->setDefaultValue('1000'),
            AdminFormElement::text('height', 'Высота (мм)')->required()->setDefaultValue('1000'),
        ]);

        $tabs[] = AdminDisplay::tab($form)->setLabel('Информация')->setActive(true)->setIcon('<i class="fa fa-credit-card"></i>');
            // 
            // if (! is_null($id)) {
            //     $typevars = AdminSection::getModel(Variable::class)->fireDisplay();
            //     // $typevars->getScopes()->push(['withContact', $id]);
            //     // $typevars->setParameter('contact_id', $id);
            //     #$typevars->getScopes()->push(['withTypeVar', $id]);
            //     $typevars->setParameter('var_id', '1');
            //     $tabs[] = AdminDisplay::tab($typevars)->setLabel('Параметры')->setIcon('<i class="fa fa-university"></i>');
            // }
            // 
        return $tabs;
        });
        return $display;
    });


});
    // ->addMenuPage(Type::class)
    // ->setIcon('fa fa-database')
    // ->setPriority(20);

