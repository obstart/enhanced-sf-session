# Enhanced Symfony Session

This is an improved version of the Symfony Session that adds a couple of features which I think is very useful but couldn't find in the original class:

- Support for manipulating arrays/lists
- Support for working within a fixed namespace

I may add more features in the future, but for the moment I think this is enough for my particular needs.

## Dependencies

Since this is an extension of the main Symfony Session class, the only requirement is that you have the http-foundation component installed. You can install http-foundation through composer like this: 

```
composer require symfony/http-foundation
```

My Session class will extend from Symfony\Component\HttpFoundation\Session\Session. See below how you can start using it.

## Installation and Usage

Just download this repo or clone it via git then include it like this:

```
<?php
require_once('path/to/obstart/enhanced-sf-session/Session.php');
$session = new Obstart\EnhancedSymfonySession\Session();
```

### With Composer

If you want this class to be autoloaded by composer, just add a psr-4 entry to the autoload section of yor composer.json:

```
...
    "autoload" : {
    	"psr-4" : {
    		"Obstart\\EnhancedSymfonySession\\" : "../path/to/obstart/enhanced-sf-session/"
    	}
    },
...
```

## Manipulating Arrays/Lists

Say you want to store a list of terms that have been searched in your website. The example below demonstrate how to go about doing that:

```
<?php

require_once __DIR__.'/vendor/autoload.php';

use Obstart\EnhancedSymfonySession\Session;

$session = new Session();
$arrayObject = $session->getArray('search_history');

```

With the $arrayObject is an instance of php's ArrayObject class. So you can just use it's API:

```
$arrayObject->append("search term 1");
$arrayObject->append("search term 2");

```

### Automatic persistence

*Important*: there is no need to set the $arrayObject back to the 'search_history' storage for persistence. Since an object's reference is returned, all modifications done to the $arrayObject instance will be automatically persisted. In other words, you don't need to do this:

```
// DON'T DO THIS !!!
$session->set('search_history',$arrayObject);
```

### Iterating the array

If you want to manipulate the contents of your array in the following requests, you just have to get the array object and iterate it's elements: 

```
// Following request: iterate values previously set
$arrayObject = $session->getArray('search_history');

foreach($arrayObject as $item){
	echo $item.'<br/>';
}
```

### Clearing the array

If you want to erase the contents of your array, you can call the ArrayObject::exchangeArray method on the object:

```
// Third request: clear array
$arrayObject->exchangeArray([]);
```

## Working with Fixed Namespace

The idea is to set a namespace once in an instance object and then all following calls to get and set methods in that object will be relative to that namespace. However I have not finished implementing this feature yet. Coming up soon :)









