<?php

namespace Application\ECommerceBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ECommerceControllerTest extends WebTestCase
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
