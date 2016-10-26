#!/usr/bin/env php
<?php

/** @var Doctrine\ORM\EntityManager $entityManager */
$entityManager = require_once 'bootstrap.php';

$productManager = new ProductManager($entityManager);

$product = $productManager->find($argv[1]);

if ($product === null) {
    echo "No product found.\n";
    exit(1);
}

echo sprintf("-%s\n", $product->getName());
