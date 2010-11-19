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

class UserRepository extends DocumentRepository
{
    public function findOneBySlug($slug)
    {
        return $this->findOneBy(array('slug' => strtolower($slug)));
    }
}
