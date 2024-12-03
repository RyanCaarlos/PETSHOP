<?php
session_start();
if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])){
  
  require '../conexao.php';
  require '../methods/Usuario.class.php';

  $u = new Usuario();

  $email = addslashes($_POST['email']);
  $password = addslashes($_POST['password']);

  if($u->login($email, $password)){
    header("Location: ../index.php");
    exit();  
  } else {  
    header("Location: ../templates/login.php?error=1");
    exit();
  }
}else{
  header("Location: ../templates/login.php?error=2");
  exit();
}
?>
