<?php
 // ESSE ARQUIVO É A CONFIG DA CONEXAO COM O BANCO DE DADOS!! NAO MEXER
 if (session_status() === PHP_SESSION_NONE) {
  session_start();
}


$localhost = "localhost";
$user = "root";
$passw = "";
$banco = "loja";

global $pdo;

try{
  // orientada a objetos com PDO
  $pdo = new PDO("mysql:dbname=".$banco."; host=".$localhost, $user, $passw);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e){
  echo "ERRO: ".$e->getMessage();
  exit; 
}

?>