<?php

namespace Application\ECommerceBundle\Tests\TestCase;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Doctrine\Common\DataFixtures\Loader;

class TestCase extends WebTestCase
{
    public function getKernel(array $options = array())
    {
        if( ! $this->kernel) {
            $this->kernel = $this->createKernel($options);
            $this->kernel->boot();
        }

        return $this->kernel;
    }

    /**
     * @return Doctrine\ORM\EntityManager
     */
    public function getEm()
    {
        $kernel = $this->getKernel();

        return $kernel->getContainer()->get('doctrine.orm.entity_manager');
    }

    /**
     * @return Doctrine\ODM\MongoDB\DocumentManager
     */
    public function getDm()
    {
        $kernel = $this->getKernel();

        return $kernel->getContainer()->get('doctrine.odm.mongodb.document_manager');
    }

    public function loadMongoDBDataFixtures($append = false)
    {
        $dm = $this->getDm();

        $loader = new Loader();
        foreach ($this->getDataFixturesPaths('MongoDB') as $path) {
            $loader->loadFromDirectory($path);
        }
        $fixtures = $loader->getFixtures();
        $purger = new \Doctrine\Common\DataFixtures\Purger\MongoDBPurger($dm);
        $executor = new \Doctrine\Common\DataFixtures\Executor\MongoDBExecutor($dm, $purger);
        $executor->execute($fixtures, $append);
    }

    public function loadORMDataFixtures($append = false)
    {
        $em = $this->getEm();

        $loader = new Loader();
        foreach ($this->getDataFixturesPaths('ORM') as $path) {
            $loader->loadFromDirectory($path);
        }
        $fixtures = $loader->getFixtures();
        $purger = new \Doctrine\Common\DataFixtures\Purger\ORMPurger($em);
        $executor = new \Doctrine\Common\DataFixtures\Executor\ORMExecutor($em, $purger);
        $executor->execute($fixtures, $append);
    }

    public function getDataFixturesPaths($lastDir = '', $testDir = '')
    {
        $paths = array();
        $bundleDirs = $this->getKernel()->getBundleDirs();
        foreach ($this->getKernel()->getBundles() as $bundle) {
            $tmp = dirname(str_replace('\\', '/', get_class($bundle)));
            $namespace = str_replace('/', '\\', dirname($tmp));
            $class = basename($tmp);

            if (isset($bundleDirs[$namespace]) && is_dir($dir = $bundleDirs[$namespace].'/'.$class.'/'.$testDir.'/DataFixtures/'.$lastDir)) {
                $paths[] = $dir;
            }
        }

        return $paths;
    }
}

