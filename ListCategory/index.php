<?php 
session_start();
require_once("../db_connect/index.php");
$res=$pdo->prepare("select * from categories");
$res->execute();

$category=$res->fetchAll();
$page_title="ListCategory";
$template="ListCategory";
include "../dashBoard.phtml";
?>