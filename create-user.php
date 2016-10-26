#!/usr/bin/env php
<?php

/** @var Doctrine\ORM\EntityManager $entityManager */
$entityManager = require_once 'bootstrap.php';

$userManager = new UserManager($entityManager);
$user = $userManager->create($argv[1]);

echo "Created User with ID " . $user->getId() . "\n";
