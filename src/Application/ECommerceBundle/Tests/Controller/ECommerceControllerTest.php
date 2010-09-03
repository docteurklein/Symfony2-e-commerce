<?php

namespace Application\ECommerceBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ECommerceControllerTest extends WebTestCase
{
    /**
     * @expectedException PHPUnit_Framework_Error
     */
    public function testIndex()
    {
        $client = $this->createClient();

        $crawler = $client->request('GET', '/');

        $this->assertRegExp('/products/', $client->getResponse()->getContent());
    }
}
