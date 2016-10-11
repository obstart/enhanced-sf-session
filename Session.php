<?php

namespace Obstart\EnhancedSymfonySession;
use Symfony\Component\HttpFoundation\Session\Session as SymfonySession;

class Session extends SymfonySession{

	protected $namespace = '';

	function setNamespace($namespace){
		$this->namespace = $namespace;
		return $this;
	}

	function getNamespace(){
		return $this->namespace;
	}

	/**
	 * Gets a stored value as ArrayObject instance
	 * You don't need to set the value back after altering
	 * the array through the ArrayObject API
	 *
	 * @param $key string
	 * @param $default array
	 * @return \ArrayObject
	 */
	function getArray($key, array $default=[]){
		$array = $this->get($key, $default);
		if(!is_array($array) && !$array instanceof \ArrayObject){
			throw new \UnexpectedValueException("Session key '$key' should contain an array or ArrayObject instance.");
		}
		$arrayObject = is_array($array) ? new \ArrayObject($array) : $array;
		$this->set($key, $arrayObject);
		return $arrayObject;

	}

}