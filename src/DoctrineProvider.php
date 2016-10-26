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
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager()
    {
        if (null === $this->entityManager) {
            // Create a simple "default" Doctrine ORM configuration for Annotations
            $isDevMode = true;
            $config = Setup::createAnnotationMetadataConfiguration(array($this->path . "/src"), $isDevMode);
            // or if you prefer yaml or XML
            //$config = Setup::createXMLMetadataConfiguration(array(__DIR__."/config/xml"), $isDevMode);
            //$config = Setup::createYAMLMetadataConfiguration(array(__DIR__."/config/yaml"), $isDevMode);

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
