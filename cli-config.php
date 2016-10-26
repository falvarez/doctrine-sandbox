#!/usr/bin/env php
<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;

/** @var Doctrine\ORM\EntityManager $entityManager */
$entityManager = require_once 'bootstrap.php';

return ConsoleRunner::createHelperSet($entityManager);
