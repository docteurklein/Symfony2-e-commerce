<?php

namespace Bundle\ECommerce\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Bundle\ECommerce\ProductBundle\Document\Product;
use Bundle\ECommerce\ProductBundle\Filter\Filter;

class ProductController extends Controller
{
    public function indexAction($page = 1)
    {
        $pager = $this->getPager();
        $pager->setCurrentPageNumber($page);

        return $this->render('ProductBundle:Product:index.php', array(
            'pager' => $pager,
            'filter' => $this->get('ecommerce.filter.product')
        ));
    }

    protected function getPager()
    {
        $builder = $this->get('ecommerce.repository.product')->getBuilder();
        $pagerFactory = $this->get('ecommerce.paginator.product.factory');
        $filter = $this->get('ecommerce.filter.product');

        $filterValues = $this->getFilterValues();
        $filter->getForm()->setData($filterValues);
        $builder = $filter->buildQuery($filterValues, $builder);

        return \call_user_func($pagerFactory, $builder);
    }

    protected function getFilterValues()
    {
        $filterValues = $this->get('session')->get('filters', array());

        return $filterValues;
    }

    protected function setFilterValues(array $filterValues = array())
    {
        $this->get('session')->set('filters', $filterValues);
    }

    /**
     * Updates the filters
     */
    public function filterAction()
    {
        $form = $this->get('ecommerce.filter.product.form');
        $form->bind($this->get('request')->get($form->getName(), array()));

        if($form->isValid()) {
            $this->setFilterValues($form->getData());

            return $this->redirect($this->generateUrl('products'));
        }

        return $this->indexAction();
    }

    public function showAction(Product $product)
    {
        if( ! $product) {
            throw new NotFoundHttpException(sprintf('The product %s does not exist.', $this->get('request')->get('slug')));
        }

        return $this->render('ProductBundle:Product:show.php', array('product' => $product));
    }
}

