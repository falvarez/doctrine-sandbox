#!/usr/bin/env php
<?php

/** @var Doctrine\ORM\EntityManager $entityManager */
$entityManager = require_once 'bootstrap.php';

$productManager = new ProductManager($entityManager);

$product = $productManager->update($argv[1], $argv[2]);

if ($product === null) {
    echo "Product $argv[1] does not exist.\n";
    exit(1);
}

echo sprintf("-%s\n", $product->getName());
