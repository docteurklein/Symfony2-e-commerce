<?php $view->extend('ECommerceBundle::layout.php') ?>

<h1><?php echo $view['translator']->trans('Customers') ?></h1>

<ul>
<?php foreach($customers as $customer): ?>
    <li><a href="<?php echo $view['router']->generate('ecommerce_customer_show', array('id' => $customer->getId())) ?>"><?php echo $customer ?></a></li>
<?php endforeach ?>
</ul>