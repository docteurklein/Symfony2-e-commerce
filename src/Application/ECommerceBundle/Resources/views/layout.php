<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        
        <link href="<?php echo $view->assets->getUrl('bundles/ecommerce/css/layout.css') ?>" rel="stylesheet" type="text/css" />
        
        <title><?php $view->slots->output('title', 'Symfony e-Commerce Solution') ?></title>
    </head>
    <body>
        <?php echo $view->actions->render('ECommerceBundle:Default:header', array(
          'standalone' => true
        )) ?>
        <section id="content" class="body">
            <?php $view->slots->output('_content') ?>
        </section>
        <?php  echo $view->actions->render('ECommerceBundle:Default:footer', array(
          'standalone' => true
        )) ?>
    </body>
</html>
