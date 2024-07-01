<?php

    $pdo=new PDO("mysql:host=localhost;dbname=boycott_bd;",'root','');

    $users=$pdo->query('select * from users');
    var_dump(($users->fetchAll()));
?>
