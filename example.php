<?php

require_once __DIR__.'/vendor/autoload.php';

use Obstart\EnhancedSymfonySession\Session;

$session = new Session();
$arrayObject = $session->getArray('search_history');

// First request: add some content
//$arrayObject->append("search term 1");
//$arrayObject->append("search term 2");

// no need to set back

// Second request: iteraate values previously set
foreach($arrayObject as $item){
	echo $item.'<br/>';
}

// Third request: clear array
$arrayObject->exchangeArray([]);

//dump($arrayObject);
