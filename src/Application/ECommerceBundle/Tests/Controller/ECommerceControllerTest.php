<?php

namespace Application\ECommerceBundle\Tests\Controller;

use Application\ECommerceBundle\Tests\TestCase\TestCase;

class ECommerceControllerTest extends TestCase
{
    /**
     */
    public function testIndex()
    {
        $client = $this->createClient();

        $crawler = $client->request('GET', '/');
        
        $this->assertRegExp('/products/', $client->getResponse()->getContent());
    }
}
