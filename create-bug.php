#!/usr/bin/env php
<?php

/** @var Doctrine\ORM\EntityManager $entityManager */
$entityManager = require_once 'bootstrap.php';

$bugManager = new BugManager($entityManager);
$bug = $bugManager->create($argv[1], $argv[2], explode(',', $argv[3]));

if (null === $bug) {
    echo "No reporter and/or engineer found for the input.\n";
}

echo "Your new Bug Id: ".$bug->getId()."\n";
