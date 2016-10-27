#!/usr/bin/env php
<?php

/** @var Doctrine\ORM\EntityManager $entityManager */
$entityManager = require_once 'bootstrap.php';

$bugManager = new BugManager($entityManager);

$myBugs = $bugManager->findAllByUserEngineerOrReporter($argv[1]);

echo "You have created or assigned to " . count($myBugs) . " open bugs:\n\n";

foreach ($myBugs as $bug) {
    echo $bug->getId() . " - " . $bug->getDescription()."\n";
}

global $doctrineDebugStack;
echo (count($doctrineDebugStack->queries) . " queries performed\n");
