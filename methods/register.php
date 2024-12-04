<?php 
require '../conexao.php';
session_start(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $queryCheck = "SELECT * FROM users WHERE email = :email";
    $stmtCheck = $pdo->prepare($queryCheck);
    $stmtCheck->bindParam(':email', $email);
    $stmtCheck->execute();

    if ($stmtCheck->rowCount() > 0) {
        $_SESSION['erro'] = "Erro: O email já está sendo usado. Tente outro.";
        header("Location: ../templates/cadastro.php"); 
        exit;
    } else {
        $query = "INSERT INTO users (first_name, email, password) VALUES (:first_name, :email, :password)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);

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
