<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        
        <link href="<?php echo $view->assets->getUrl('bundles/ecommerce/css/layout.css') ?>" rel="stylesheet" type="text/css" />
        
        <title><?php $view->slots->output('title', 'Symfony e-Commerce Solution') ?></title>
    </head>
    <body>
        <header id="banner" class="body">
            <h1><a href="<?php echo $view->router->generate('homepage') ?>">Symfony e-Commerce Solution</a></h1>
            <nav><ul>
                <li class="active"><a href="<?php echo $view->router->generate('homepage') ?>">home</a></li>
                <li><a href="#">portfolio</a></li>
                <li><a href="#">blog</a></li>
                <li><a href="#">contact</a></li>
            </ul></nav>
        </header
        <section id="content" class="body">
            <?php $view->slots->output('_content') ?>
        </body>
        <footer id="contentinfo" class="body">
            <address id="about" class="vcard body">
                <span class="primary">
                    <strong><a href="http://github.com/docteurklein/Symfony2-e-commerce" class="fn url">e-Commerce Symfony Solution</a></strong>
                    <span class="role">Amazing dev</span>
                </span>
            </address>
            <p>2010 <a href="http://github.com/docteurklein">Klein Florian</a>.</p>
        </footer>
    </body>
</html>