<?php 
require_once("../../db_connect/index.php");
$errors=[];
$nom="";
$prenom = "";
$email = "";
$password = "";

if(array_key_exists('submit',$_POST)){
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    if(empty($nom)){
        $errors['nom'] = 'Nom required';
    }
    if(empty($prenom)){
        $errors['prenom'] = 'Prenom required';
    }
    if(empty($email)){
        $errors['email'] = 'Email required';
    }
    if(empty($password)){
        $errors['password'] = 'Password required';
    }
    if(empty($errors)){
        $user_email=$pdo->prepare("select * from users where email=:email");
        $user_email->execute([
            "email"=>$email
        ]);
        $verify=$user_email->fetchAll();
        if(empty($verify)){
            $user=$pdo->prepare("INSERT INTO `users`( `nom`, `prenom`, `email`, `password`) VALUES (:nom,:prenom,:email,:pass)");
            $user->execute([
                "nom" => $nom,
                "prenom" => $prenom,
                "email" => $email,
                "pass" => password_hash($password, PASSWORD_DEFAULT)
            ]);
            header("location:../index.php?message=User Added");
        }else{
            $errors['email']="Email already exist";
        }
    }
}
$page_title="Add User";
$template="addUser";
include "../../layout.phtml";

?>