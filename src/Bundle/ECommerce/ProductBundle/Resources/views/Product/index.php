<?php $view->extend('ECommerceBundle::layout') ?>

<h1><?php //echo $view->i18n->translate('Products') ?></h1>
<h1><?php echo ('Products') ?></h1>

<ul>
<?php foreach($products as $product): ?>
    <li><a href="<?php echo $view['router']->generate('product_show', array('id' => $product->getId())) ?>"><?php echo $product ?></a></li>
<?php endforeach ?>
</ul>

