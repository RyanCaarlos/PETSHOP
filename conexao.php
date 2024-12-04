<?php

// Verificar se a sessão já foi iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Configurações de conexão ao servidor MySQL, mudar localhost para id do myadmin caso não funcione!!
$localhost = "localhost";
$user = "root";
$passw = "";

global $pdo;

// Conexão inicial para criação do banco de dados
try {
    $pdo = new PDO("mysql:host=" . $localhost, $user, $passw);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Criar o banco de dados se não existir
    $pdo->exec("CREATE DATABASE IF NOT EXISTS Loja");
    $pdo->exec("USE Loja");

    // Criar a tabela users se não existir
    $createTableSQL = "
    CREATE TABLE IF NOT EXISTS users (
        user_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(200) NOT NULL,
        last_name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        password VARCHAR(150) NOT NULL,
        contact_no VARCHAR(10) NOT NULL,
        registered_at DATE NOT NULL DEFAULT current_timestamp(),
        isAdmin INT(11) NOT NULL DEFAULT 0,
        user_address VARCHAR(255) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
    $pdo->exec($createTableSQL);

    // Mensagem de sucesso no log (não aparece na página)
    error_log("Banco de dados e tabela configurados com sucesso!");
} catch (PDOException $e) {
    error_log("ERRO: " . $e->getMessage());
    exit;
}

// Função para inserir um usuário
function inserirUsuario($firstName, $lastName, $email, $password, $contactNo, $userAddress, $isAdmin = 0) {
    global $pdo;

    try {
        $sql = "INSERT INTO users (first_name, last_name, email, password, contact_no, user_address, isAdmin) 
                VALUES (:first_name, :last_name, :email, :password, :contact_no, :user_address, :isAdmin)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":first_name", $firstName);
        $stmt->bindValue(":last_name", $lastName);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":password", password_hash($password, PASSWORD_DEFAULT)); // Hash da senha
        $stmt->bindValue(":contact_no", $contactNo);
        $stmt->bindValue(":user_address", $userAddress);
        $stmt->bindValue(":isAdmin", $isAdmin);
        $stmt->execute();

        // Mensagem de sucesso no log
        error_log("Usuário inserido com sucesso: $firstName $lastName");
    } catch (PDOException $e) {
        error_log("Erro ao inserir usuário: " . $e->getMessage());
    }
}

// Função para buscar todos os usuários (sem exibir diretamente)
function buscarUsuarios() {
    global $pdo;

    try {
        $sql = "SELECT * FROM users";
        $stmt = $pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erro ao buscar usuários: " . $e->getMessage());
        return [];
    }
}

// Exemplo de uso das funções
inserirUsuario('Admin', 'Admin', 'admin@gmail.com', 'senha123', '9810283472', 'newroad', 1);
//inserirUsuario('Test', 'Firstuser', 'test@gmail.com', 'senha456', '980098322', 'matepani-12', 0);
$usuarios = buscarUsuarios();

// Mensagens de depuração no log (opcional, não aparecem na página)
error_log("Usuários cadastrados: " . json_encode($usuarios));

?>
