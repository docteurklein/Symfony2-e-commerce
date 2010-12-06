<?php

/**
 * This file is part of the Symfony framework.
 *
 * @author Klein Florian <florian.klein@free.fr>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Bundle\ECommerce\ProductBundle\Document;

use Doctrine\ODM\MongoDB\DocumentRepository;

class CategoryRepository extends DocumentRepository
{
    public function findOneBySlug($slug)
    {
        return $this->findOneBy(array('slug' => strtolower($slug)));
    }

    public function getTree($path = '/', $separator = '/')
    {
        $query = $this->createQuery()
            ->sort('path', 'asc');

        if($path and $path != '/') {
            $query->field('path')->equals(new \MongoRegex(sprintf('/^%s\%s/', $path, $separator)));
        }

        return $query->execute();
    }
}
