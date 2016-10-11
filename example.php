<?php

require_once __DIR__.'/vendor/autoload.php';

use Obstart\EnhancedSymfonySession\Session;

$session = new Session();
$arrayObject = $session->getArray('search_history');

dump($arrayObject);
