#!/usr/bin/env php
<?php

/** @var Doctrine\ORM\EntityManager $entityManager */
$entityManager = require_once 'bootstrap.php';

$productManager = new ProductManager($entityManager);
$product = $productManager->create($argv[1]);

echo "Created Product with ID " . $product->getId() . "\n";
