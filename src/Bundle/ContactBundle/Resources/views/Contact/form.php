<?php $view->extend('ECommerceBundle::layout.php') ?>

<form action="<?php echo $view['router']->generate('contact_post') ?>" method="POST">
    <?php echo $view['form']->errors($form) ?>
    <table>
        <?php echo $view['form']->label($form['email']) ?>
        <?php echo $view['form']->render($form['email']) ?>
        <?php echo $view['form']->errors($form['email']) ?>
        
        <?php echo $view['form']->label($form['subject']) ?>
        <?php echo $view['form']->render($form['subject']) ?>
        <?php echo $view['form']->errors($form['subject']) ?>
        
        <?php echo $view['form']->label($form['message']) ?>
        <?php echo $view['form']->render($form['message']) ?>
        <?php echo $view['form']->errors($form['message']) ?>
    </table>
    <?php echo $view['form']->hidden($form) ?>
    <input type="submit" />
</form>
