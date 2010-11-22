<?php

namespace Bundle\ECommerce\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Bundle\ECommerce\ProductBundle\Document\Category;

class CategoryController extends Controller
{
    public function indexAction()
    {
        $categories = $this->get('ecommerce.repository.category')->find();
        return $this->render('ProductBundle:Category:index.php', array('categories' => $categories));
    }

    public function showAction($slug)
    {
        $category = $this->get('ecommerce.repository.category')->findOneBySlug($slug);

        if( ! $category) {
            throw new NotFoundHttpException('The category does not exist.');
        }

        return $this->render('ProductBundle:Category:show.php', array('category' => $category));
    }
}
