<?php $view->extend('ECommerceBundle::layout.php') ?>

<h1><?php echo $view['translator']->trans('Categories') ?></h1>
<?php echo $view['menu']->render('category') ?>

<h1><?php echo $view['translator']->trans('Products') ?></h1>

<ul>
<?php foreach($products as $product): ?>
    <li><a href="<?php echo $view['router']->generate('product_show', array('slug' => $product->getSlug())) ?>"><?php echo $product ?></a></li>
<?php endforeach ?>
</ul>

