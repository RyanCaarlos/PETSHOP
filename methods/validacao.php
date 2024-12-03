<?php
session_start();
if(isset($_POST['email']) & !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])){

  require '../conexao.php';
  require '../methods/Usuario.class.php';

  $u = new Usuario();

  $email = addslashes($_POST['email']);
  $password = addslashes($_POST['password']);

  if($u->login($email, $password) == true){
    if(isset($_SESSION['idUser'])){
      header("Location: ../templates/admin_panel/index.php");
    }else{
      header("Location: ../templates/admin_panel/index.php");
    }
    }else{
      header("Location: ../templates/admin_panel/index.php");
    }

}else{
  header("Location: ../templates/admin_panel/index.php");
}

?>