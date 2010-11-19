<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        
        <title><?php $view['slots']->output('title', 'Symfony e-Commerce Solution') ?></title>
        <meta content="<?php $view['slots']->output('description') ?>" name="description">
        <link rel="shortcut icon" href="/favicon.png" type="image/png" />
        
        <?php $view['assets']->setVersion('1') ?>
        <?php $view['stylesheets']->add('bundles/ecommerce/css/layout.css') ?>
        <?php echo $view['stylesheets'] ?>
    </head>
    <body>
        <?php echo $view['actions']->render('ECommerceBundle:Default:header', array(
          'standalone' => true
        )) ?>
        <section id="content" class="body">
            <?php $view['slots']->output('_content') ?>
        </section>
        <?php echo $view['actions']->render('ECommerceBundle:Default:footer', array(
          'standalone' => true
        )) ?>
    </body>
</html>
