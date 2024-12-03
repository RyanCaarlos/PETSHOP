<?php 
session_start(); 
$erro = isset($_SESSION['erro']) ? $_SESSION['erro'] : ''; 
unset($_SESSION['erro']);
?>
<!DOCTYPE html> 
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jardim Pet</title>
    <link rel="stylesheet" href="form-user.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap');
        .error-message {
            color: red;
            font-size: 17px;
            text-align: center;
            margin: 10px 0;
            opacity: 1;
            transition: opacity 1s ease-in-out;
        }
        .error-message.hidden {
            opacity: 0; 
        }
    </style>
</head>
<body>
    <div id="form-container2">
        <p class="title">Cadastro</p>
        <form class="form" action="../methods/register.php" method="POST">
            <input type="text" name="first_name" class="input" placeholder="Nome" required>
            <input type="email" name="email" class="input" placeholder="Email" required>
            <input type="password" name="password" class="input" placeholder="Senha" required>
            <button type="submit" class="button2">Cadastrar</button>
            
            <!-- Exibe a mensagem de erro, se houver -->
            <?php if (!empty($erro)) { ?>
                <p class="error-message" id="error-message"><?php echo $erro; ?></p>
            <?php } ?>

        </form>
        <p class="sign-up-label">
            Já possui uma conta?
            <a href="login.php">
                <span class="sign-up-link">Acessar</span>
            </a>
        </p>
    </div>
    <script>
        const errorMessage = document.getElementById('error-message');
        if (errorMessage) {
            setTimeout(() => {
                errorMessage.classList.add('hidden'); 
            }, 6000); 
            setTimeout(() => {
                errorMessage.style.display = 'none'; 
            }, 7000); 
        }
    </script>
</body>
</html>
