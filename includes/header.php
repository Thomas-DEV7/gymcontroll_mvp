<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>


<nav class="navbar navbar-dark">
    <div class="container-fluid">
        <!-- Logo como imagem -->
        <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
            <img src="../assets/img/logo.png" alt="GymControll" height="59">
        </a>

        <div class="d-flex align-items-center">
            <span class="me-3">Olá, <?= htmlspecialchars($_SESSION['user']['name']) ?></span>
            <a href="../controllers/AuthController.php?action=logout" class="btn btn-sm btn-logout">Sair</a>
        </div>
    </div>
</nav>