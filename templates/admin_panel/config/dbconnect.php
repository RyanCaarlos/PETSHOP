<?php
$server = "localhost";
$user = "root";
$password = "";
$db = "loja";

$conn = new mysqli($server, $user, $password, $db);

// Verifica a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Conexão bem-sucedida!";
}

?>
