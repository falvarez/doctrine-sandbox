#!/usr/bin/env php
<?php

/** @var Doctrine\ORM\EntityManager $entityManager */
$entityManager = require_once 'bootstrap.php';

$productManager = new ProductManager($entityManager);

foreach ($productManager->findAll() as $product) {
    echo sprintf("-%s\n", $product->getName());
}
