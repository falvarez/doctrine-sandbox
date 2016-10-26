<?php

require_once 'vendor/autoload.php';

return (new DoctrineProvider(__DIR__))->getEntityManager();
