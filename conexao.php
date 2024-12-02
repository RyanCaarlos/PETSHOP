<?php

// Verificar se a sessão já foi iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Configurações de conexão ao servidor MySQL
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

    // Criar a tabela usuarios se não existir
    $createTableSQL = "
    CREATE TABLE IF NOT EXISTS usuarios (
        id_usuario INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(100) NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        senha VARCHAR(255) NOT NULL,
        userNivel ENUM('admin', 'cliente') DEFAULT 'cliente'
    )";
    $pdo->exec($createTableSQL);

    // Mensagem de sucesso no log (não aparece na página)
    error_log("Banco de dados e tabela configurados com sucesso!");
} catch (PDOException $e) {
    error_log("ERRO: " . $e->getMessage());
    exit;
}

// Função para inserir um usuário
function inserirUsuario($nome, $email, $senha, $userNivel = 'cliente') {
    global $pdo;

    try {
        $sql = "INSERT INTO usuarios (nome, email, senha, userNivel) VALUES (:nome, :email, :senha, :userNivel)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":nome", $nome);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":senha", password_hash($senha, PASSWORD_DEFAULT)); // Hash da senha
        $stmt->bindValue(":userNivel", $userNivel);
        $stmt->execute();

        // Mensagem de sucesso no log
        error_log("Usuário inserido com sucesso: $nome");
    } catch (PDOException $e) {
        error_log("Erro ao inserir usuário: " . $e->getMessage());
    }
}

// Função para buscar todos os usuários (sem exibir diretamente)
function buscarUsuarios() {
    global $pdo;

    try {
        $sql = "SELECT * FROM usuarios";
        $stmt = $pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erro ao buscar usuários: " . $e->getMessage());
        return [];
    }
}

// Exemplo de uso das funções
inserirUsuario('Maria', 'maria@email.com', '12345', 'admin');
inserirUsuario('João', 'joao@email.com', '67890', 'cliente');
$usuarios = buscarUsuarios();

// Mensagens de depuração no log (opcional, não aparecem na página)
error_log("Usuários cadastrados: " . json_encode($usuarios));

?>