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
    protected $repository;
    protected $router;

    public function __contruct(CategoryRepository $repository, RouterInterface $router, array $attributes = array(), $childClass = 'Bundle\MenuBundle\MenuItem')
    {
        parent::__construct($attributes, $childClass);

        $this->repository = $repository;
        $this->router = $router;
    }

    public function generateDefault()
    {
        foreach($this->repository->find() as $category)
        {
            $child = $this->createChild((string) $category, $this->router->generate('category_show', array('slug' => $category->getSlug())));
            $this->addChild($child);
        }

        return $this;
    }
}
