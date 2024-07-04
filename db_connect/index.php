<?php

    define('local','localhost');
    define('user','root');
    define('pass','');
    define('name','boycott_bd');
    $pdo=new PDO('mysql:host='.local.';dbname='.name,user,pass);
?>
