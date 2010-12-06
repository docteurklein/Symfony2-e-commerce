<?php $view->extend('ECommerceBundle::layout.php') ?>

<h1><?php echo $category ?></h1>

<?php echo $view['menu']->render('category', $category->getPath()) ?>

<?php foreach($category->getProducts() as $product): ?>
    <div>
        <a href="<?php echo $view['router']->generate('product_show', array('slug' => $product->getSlug())) ?>"><?php echo $product ?></a>
    </div>
<?php endforeach ?>
