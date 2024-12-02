<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jardim Pet</title>
    <link rel="stylesheet" href="form-user.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>
</head>
<body>
    <div class="form-container">
        <p class="title">Seja bem-vindo(a)!</p>
        <form class="form" action="../methods/logar.php" method="post">
            <input type="email" name="email" class="input" placeholder="Email" required>
            <input type="password" name="senha" class="input" placeholder="Senha" required>
            <button type="submit" class="button2">Entrar</button>
        </form>
        <p class="sign-up-label">
            Não tem uma conta?
            <a href="../templates/cadastro.php">
                <span class="sign-up-link">Criar conta</span>
            </a>
        </p>
    </div>
</body>
</html>
