<?php

namespace Bundle\ECommerce\ProductBundle\Menu;

use Bundle\ECommerce\ProductBundle\Document\CategoryRepository;
use Bundle\MenuBundle\Menu;
use Symfony\Component\Routing\RouterInterface;

/**
 * User: florian
 */

class Category extends Menu
{
    /**
     * @var CategoryRepository $repository
     */
    protected $repository;

    /**
     * @var RouterInterface $router the routing system
     */
    protected $router;

    public function __contruct(CategoryRepository $repository, RouterInterface $router, array $attributes = array(), $childClass = 'Bundle\MenuBundle\MenuItem')
    {
        parent::__construct($attributes, $childClass);

        $this->repository = $repository;
        $this->router = $router;

        $this->generateDefault();
    }

    public function generateDefault()
    {
        $child = $this->createChild('Catalog', $this->router->generate('product_index'));
        $this->addChild($child);
        foreach($this->repository->find() as $category)
        {
            $child = $this->createChild((string) $category, $this->router->generate('category_show', array('slug' => $category->getSlug())));
            $this->addChild($child);
        }

        return $this;
    }
}
