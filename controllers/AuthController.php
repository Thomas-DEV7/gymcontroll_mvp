<?php
require_once '../config/database.php';
session_start();

$action = $_GET['action'] ?? '';

if ($action === 'register') {
    register();
} elseif ($action === 'login') {
    login();
} elseif ($action === 'logout') {
    logout();
}

function register() {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $pdo = getDatabaseConnection();

    $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    if ($stmt->execute([$name, $email, $password])) {
        $_SESSION['toast'] = ['type' => 'success', 'message' => 'Cadastro realizado com sucesso!'];
        header("Location: ../public/login.php");
    } else {
        $_SESSION['toast'] = ['type' => 'danger', 'message' => 'Erro ao cadastrar usuário.'];
        header("Location: ../public/cadastro.php");
    }
}

function login() {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $pdo = getDatabaseConnection();

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        $_SESSION['toast'] = ['type' => 'success', 'message' => 'Login realizado com sucesso!'];
        header("Location: ../public/dashboard.php");
    } else {
        $_SESSION['toast'] = ['type' => 'danger', 'message' => 'Credenciais inválidas.'];
        header("Location: ../public/login.php");
    }
}

function logout() {
    session_destroy();
    header("Location: ../public/login.php");
}
