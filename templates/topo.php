<header>
    <div class="logo">
        <div>
            <img src="img/Top navigation bar.png" alt="logo">
        </div>
    </div>
    <div class="container">
        <div class="botoes" onclick="redirectToAdminLogin()">Administrador</div>
        <div class="botoes" onclick="redirectToLogin()">Login</div>
    </div>
</header>

<script>
function redirectToAdminLogin() {
    window.location.href = 'login_adm.php';
}

function redirectToLogin() {
    window.location.href = 'login.php'; // Assuming you have a login.php file
}
</script>