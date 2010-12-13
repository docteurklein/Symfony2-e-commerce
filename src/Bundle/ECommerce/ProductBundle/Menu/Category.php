<?php

namespace Bundle\ECommerce\ProductBundle\Menu;

use Bundle\ECommerce\ProductBundle\Document\Category as CategoryDocument;
use Bundle\ECommerce\ProductBundle\Document\CategoryRepository;
use Bundle\MenuBundle\Menu;
use Bundle\MenuBundle\MenuItem;
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

    public function __construct(CategoryRepository $repository, RouterInterface $router, $childClass = 'Bundle\MenuBundle\MenuItem', array $attributes = array())
    {
        parent::__construct($attributes, $childClass);

        $this->repository = $repository;
        $this->router = $router;
    }

    public function initialize(array $options = array())
    {
        $child = $this;

        $path = isset($options['path']) ? $options['path'] : '/';
        $parents = array($path => $child);
        foreach($this->repository->getTree($path) as $category)
        {
            $new_child = $this->createChild((string) $category, $this->router->generate('category_show', array('slug' => $category->getSlug())));
            $new_child->setAttribute('class', 'level_'.$category->getLevel());

            $path = $category->getParentPath();
            if(!isset($parents[$path])) {
                $parents[$path] = $child;
            }

            $parents[$path]->addChild($new_child);

            if(!isset($parents[$category->getPath()])) {
                $parents[$category->getPath()] = $new_child;
            }
        }

        return $this;
    }
}
