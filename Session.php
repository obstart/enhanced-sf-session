<?php

namespace Obstart\EnhancedSymfonySession;
use Symfony\Component\HttpFoundation\Session\Session as SymfonySession;
use Symfony\Component\HttpFoundation\Session\Attributes\NamespacedAttributeBag;

class Session extends SymfonySession{

	protected $namespace = '';

    public function __construct(SessionStorageInterface $storage = null, FlashBagInterface $flashes = null)
    {
    	$attributeBag = new NamespacedAttributeBag();
    	parent::__construct($storage, $attributeBag, $flashes);
    }

	function setNamespace($namespace){
		$this->namespace = $namespace;
		return $this;
	}

	function getNamespace(){
		return $this->namespace;
	}

	   /**
     * {@inheritdoc}
     */
    public function has($name)
    {
    	if($this->namespace){
    		$name = $this->namespace."/".$name;
    	}
        return $this->storage->getBag($this->attributeName)->has($name);
    }

    /**
     * {@inheritdoc}
     */
    public function get($name, $default = null)
    {
    	if($this->namespace){
    		$name = $this->namespace."/".$name;
    	}

        return $this->storage->getBag($this->attributeName)->get($name, $default);
    }

    /**
     * {@inheritdoc}
     */
    public function set($name, $value)
    {
    	if($this->namespace){
    		$name = $this->namespace."/".$name;
    	}
        $this->storage->getBag($this->attributeName)->set($name, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function all()
    {
    	if($this->namespace){
    		return $this->storage->getBag($this->attributeName)->get($this->namespace);
    	}
        return $this->storage->getBag($this->attributeName)->all();
    }

    /**
     * {@inheritdoc}
     */
    public function replace(array $attributes)
    {
    	if($this->namespace){
	        $this->storage->getBag($this->attributeName)->set($this->namespace, $attributes);
    	} else {
	        $this->storage->getBag($this->attributeName)->replace($attributes);
    	}
    }

    /**
     * {@inheritdoc}
     */
    public function remove($name)
    {
    	if($this->namespace){
    		$name = $this->namespace."/".$name;
    	}

        return $this->storage->getBag($this->attributeName)->remove($name);
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
    	if($this->namespace){
			$this->replace([]);    		
    	} else {
	        $this->storage->getBag($this->attributeName)->clear();
    	}

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