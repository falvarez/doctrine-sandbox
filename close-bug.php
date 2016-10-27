#!/usr/bin/env php
<?php

/** @var Doctrine\ORM\EntityManager $entityManager */
$entityManager = require_once 'bootstrap.php';

$bugManager = new BugManager($entityManager);

/** @var Bug $bug */
$bug = $bugManager->find($argv[1]);

$bug->close();

//When retrieving the Bug from the database it is inserted into the IdentityMap inside the UnitOfWork of Doctrine. This means your Bug with exactly this id can only exist once during the whole request no matter how often you call EntityManager#find(). It even detects entities that are hydrated using DQL and are already present in the Identity Map.
//
//When flush is called the EntityManager loops over all the entities in the identity map and performs a comparison between the values originally retrieved from the database and those values the entity currently has. If at least one of these properties is different the entity is scheduled for an UPDATE against the database. Only the changed columns are updated, which offers a pretty good performance improvement compared to updating all the properties.

$entityManager->flush();

// Could be resolved inside BugManager (I personally think that it is better option)
