<?php 
require_once("../db_connect/index.php");
$res=$pdo->prepare("select * from categories");
$res->execute();

$categories=$res->fetchAll();
$page_title="ListCategory";
$template="ListCategory";
include "../layout.phtml";
?>