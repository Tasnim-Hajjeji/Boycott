<?php 
require_once('../../db_connect/index.php');
//ctype_digit :test if Id Numerique
if(!(array_key_exists('id',$_GET)or array_key_exists('id',$_POST)) and !(ctype_digit($_GET['id'] )or ctype_digit($_POST['id']))) {
    header("location:../index.php");
}
$id=array_key_exists('id',$_GET)? $_GET['id'] :$_POST['id'];

$errors=[];
if(array_key_exists('submit',$_POST)) {
    extract($_POST);
    if(empty($nom)) {
        $errors['nom'] = 'Nom required';
    }
    if(empty($prenom)){
        $errors['prenom'] = 'Prenom required';
    }
    if(empty($email)){
        $errors['email'] = 'Email required';
    }
    if(empty($errors)){
        $res=$pdo->prepare("update `users` SET `nom`=:nom,`prenom`=:prenom,`email`=:email  WHERE id=:id ");
        $res->execute([
            "nom"=>$nom,
            "prenom"=>$prenom,
            "email"=>$email,
            "id"=>$id
        ]);
        header("location:../index.php?message=User Updated");
    }    
}

$res= $pdo->prepare("select id,nom,prenom,email from users where id=:id");
$res->execute([
    "id"=>$id
]);
$user=$res->fetch();
if(!$user){
    header(("location:../index.php"));
}

$page_title="Update User";
$template="UpdateUser";

include("../../layout.phtml");

?>