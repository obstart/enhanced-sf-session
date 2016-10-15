<?php

require_once(__DIR__.'/vendor/autoload.php');

$session = new Obstart\EnhancedSymfonySession\Session();

// Enter Namespace
$session->setNamespace('submodule');

// Work inside namespace
$session->set('user_id', 5);
$session->set('user_name', 'fabio');

echo $session->get('user_id'); // 5
var_dump($session->has('user_name')); // true

$logs = $session->getArray('logs');
$logs[] = "Logged-in";
$logs[] = "Deleted whole database!!";

// Leave Namespace
$session->setNamespace('');

print_r($session->all());
/*
Array
(
    [submodule] => Array
        (
            [user_id] => 5
            [user_name] => fabio
            [logs] => ArrayObject Object
                (
                    [storage:ArrayObject:private] => Array
                        (
                            [0] => Logged-in
                            [1] => Deleted whole database!!
                        )

                )

        )

)
*/

echo $session->get('submodule/user_name'); // fabio