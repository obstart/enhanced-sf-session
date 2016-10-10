<?php

namespace Obstart\EnhancedSymfonySession;
use Symfony\Component\HttpFoundation\Session\Session as SymfonySession;

class Session extends SymfonySession{

	protected $namespace = '';

	function setNamespace(){

	}

	function getNamespace(){

	}

	function getArray($key, $default=[]){
		return new \ArrayObject;
	}

}