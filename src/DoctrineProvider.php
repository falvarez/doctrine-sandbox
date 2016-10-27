<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class DoctrineProvider
{
    protected $path;
    protected $entityManager = null;

    public function __construct($path)
    {
        $this->path = $path;
        $this->proxyPath = $path . '/proxy';
        @mkdir($this->proxyPath, 0777, true);
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager()
    {
        if (null === $this->entityManager) {
            // Create a simple "default" Doctrine ORM configuration for Annotations
            // If $isDevMode is true caching is done in memory with the ArrayCache. Proxy objects are recreated on every request.
            // If $isDevMode is false, check for Caches in the order APC, Xcache, Memcache (127.0.0.1:11211), Redis (127.0.0.1:6379) unless $cache is passed as fourth argument.
            // If $isDevMode is false, set then proxy classes have to be explicitly created through the command line.
            // If third argument $proxyDir is not set, use the systems temporary directory.
            $isDevMode = false;
            // Path points to entity files
            $config = Setup::createAnnotationMetadataConfiguration(array($this->path . "/src"), $isDevMode, $this->proxyPath);
            $config->setAutoGenerateProxyClasses(true);

            // or if you prefer yaml or XML
            //$config = Setup::createXMLMetadataConfiguration(array($this->path . "/config/xml"), $isDevMode);
            //$config = Setup::createYAMLMetadataConfiguration(array($this->path . "/config/yaml"), $isDevMode);

            // database configuration parameters
            $conn = array(
                'driver' => 'pdo_sqlite',
                'path' => $this->path . '/db.sqlite',
            );

            // obtaining the entity manager
            $this->entityManager = EntityManager::create($conn, $config);
        }
        return $this->entityManager;
    }
}
