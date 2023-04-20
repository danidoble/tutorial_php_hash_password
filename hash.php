<?php
include "vendor/autoload.php";

if(empty($_POST['password'])) {
   header('Location: index.php');
}

$database = new App\Database();
// $database->user = 'root';
$database->pass = 'pruebas00'; // constrasena de la base de datos
$database->db = 'tutorial_php_password_hash'; // nombre de la base de datos
$database->connect(); // conectar a la base de datos

// verificar si el email ya existe en la base de datos
$user = $database->get('users', ['email', "'".$_POST['email']."'"]);
// actualizar el usuario si existe
if($user) {
   $database->update('users', [
      'password' => password_hash($_POST['password'],PASSWORD_DEFAULT),
      'email' => $_POST['email'],
   ], [
      'email' => $_POST['email']
   ]);
   header('Location: index.php?success=2');
   exit();
}

// crear el usuario si no existe
$user = [
   'email' => $_POST['email'],
   'password' => password_hash($_POST['password'],PASSWORD_DEFAULT),
];
$database->insert('users', $user);
header('Location: index.php?success=1');