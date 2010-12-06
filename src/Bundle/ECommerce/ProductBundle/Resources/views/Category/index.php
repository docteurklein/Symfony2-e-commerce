<?php $view->extend('ECommerceBundle::layout.php') ?>

<h1><?php echo $view['translator']->trans('Categories') ?></h1>

<?php echo $view['menu']->render('category') ?>
