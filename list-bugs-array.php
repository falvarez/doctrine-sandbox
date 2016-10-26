#!/usr/bin/env php
<?php

/** @var Doctrine\ORM\EntityManager $entityManager */
use Doctrine\Common\Util\Debug;

$entityManager = require_once 'bootstrap.php';

$bugManager = new BugManager($entityManager);

/** @var Bug[] $bugs */
$bugs = $bugManager->findAllDQL(true);

foreach ($bugs as $bug) {
    echo $bug['description']." - ".$bug['created']->format('d.m.Y')."\n";
    echo "    Reported by: ".$bug['reporter']['name']."\n";
    echo "    Assigned to: ".$bug['engineer']['name']."\n";
    foreach ($bug['products'] as $product) {
        echo "    Platform: ".$product['name']."\n";
    }
    echo "\n";
}
