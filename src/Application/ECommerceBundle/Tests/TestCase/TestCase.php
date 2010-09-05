<?php

namespace Application\ECommerceBundle\Tests\TestCase;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestCase extends WebTestCase
{
    protected $kernel;

    public function getKernel()
    {
        if( ! $this->kernel) {
            $this->kernel = $this->createKernel();
            $this->kernel->boot();
        }

        return $this->kernel;
    }

    public function getEm()
    {
        $kernel = $this->getKernel();

        return $kernel->getContainer()->getDoctrine_Orm_DefaultEntityManagerService();
    }

    public function getDm()
    {
        $kernel = $this->getKernel();

        return $kernel->getContainer()->getDoctrine_Odm_Mongodb_DefaultDocumentManagerService();
    }
}

