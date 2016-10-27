#!/usr/bin/env php
<?php

/** @var Doctrine\ORM\EntityManager $entityManager */
$entityManager = require_once 'bootstrap.php';

$bugManager = new BugManager($entityManager);

$bug = $bugManager->find($argv[1]);

if ($bug === null) {
    echo "No bug found.\n";
    exit(1);
}

echo "Bug: ".$bug->getDescription()."\n";
echo "Engineer: ".$bug->getEngineer()->getName()."\n";
