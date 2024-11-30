<?php 

  require '../conexao.php';

  if(isset($_POST)){

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $query = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";

    $stmt = $pdo->prepare($query);
    $stmt->execute(); 
   
  }

?>