<?php

use Doctrine\DBAL\Logging\DebugStack;

require_once 'vendor/autoload.php';

global $doctrineDebugStack;

$doctrineDebugStack = new DebugStack();
$entityManager = (new DoctrineProvider(__DIR__))->getEntityManager();
$entityManager->getConfiguration()->setSQLLogger($doctrineDebugStack);

return $entityManager;
