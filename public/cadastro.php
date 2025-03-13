<?php
session_start();
if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro - GymControll</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap 5.3 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Estilo customizado Dark Mode -->
    <style>
        body {
            background-color: #121212;
            color: #ffffff;
        }
        .card {
            background-color: #1f1f1f;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.8);
        }
        .btn-primary {
            background-color: #6200EE;
            border: none;
        }
        .btn-primary:hover {
            background-color: #3700B3;
        }
        a {
            color: #BB86FC;
        }
    </style>
</head>
<body>

<div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="card p-4 w-100" style="max-width: 400px;">
        <h2 class="text-center mb-4">Criar Conta</h2>

        <?php include '../toasts/toast.php'; ?>

        <form action="../controllers/AuthController.php?action=register" method="POST">
            <div class="form-floating mb-3">
                <input type="text" class="form-control bg-dark text-white" name="name" id="name" placeholder="Nome" required>
                <label for="name">Nome Completo</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control bg-dark text-white" name="email" id="email" placeholder="E-mail" required>
                <label for="email">E-mail</label>
            </div>
            <div class="form-floating mb-4">
                <input type="password" class="form-control bg-dark text-white" name="password" id="password" placeholder="Senha" required>
                <label for="password">Senha</label>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-2">Cadastrar</button>

            <div class="text-center mt-3">
                <a href="login.php">Já possui conta? Entrar</a>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap JS para os Toasts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
