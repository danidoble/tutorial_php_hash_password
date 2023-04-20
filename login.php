<?php
include "vendor/autoload.php";

if(!isset($_POST['email']) || empty($_POST['email']) || !isset($_POST['password']) || empty($_POST['password'])){
    header('Location: index.php');
    exit();
}

$database = new App\Database();
$database->pass = 'pruebas00'; // constrasena de la base de datos
$database->db = 'tutorial_php_password_hash'; // nombre de la base de datos
$database->connect();

// verificar si el email ya existe en la base de datos
$user = $database->get('users', ['email', "'".$_POST['email']."'"]);
if(!$user){
    header('Location: index.php?error=2');
    exit();
}

// verificar si la contraseña es correcta
if(password_verify($_POST['password'], $user['password'])) {
    header('Location: index.php?success=3');
}
else{
    header('Location: index.php?error=1');
}
