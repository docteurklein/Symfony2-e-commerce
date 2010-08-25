<?php $view->extend('ECommerceBundle::layout') ?>

<h1><?php echo $product ?></h1>

<?php foreach($product->getOptions() as $option): ?>
    <div><?php echo $option ?></div>
<?php endforeach ?>

