<?php 
require '../conexao.php';
session_start(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $queryCheck = "SELECT * FROM usuarios WHERE email = :email";
    $stmtCheck = $pdo->prepare($queryCheck);
    $stmtCheck->bindParam(':email', $email);
    $stmtCheck->execute();

    if ($stmtCheck->rowCount() > 0) {
        $_SESSION['erro'] = "Erro: O email já está sendo usado. Tente outro.";
        header("Location: ../templates/cadastro.php"); 
        exit;
    } else {
        $query = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);

        if ($stmt->execute()) {
            header("Location: ../templates/login.php");
            exit;
        } else {
            $_SESSION['erro'] = "Erro ao cadastrar usuário. Tente novamente.";
            header("Location: ../templates/cadastro.php");
            exit;
        }
    }
}
