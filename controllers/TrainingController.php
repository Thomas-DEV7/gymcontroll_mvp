<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../config/database.php';

$action = $_GET['action'] ?? '';

if ($action === 'create') {
    createTraining();
} elseif ($action === 'delete') {
    deleteTraining();
}

function getUserTrainings($userId) {
    $pdo = getDatabaseConnection();

    $stmt = $pdo->prepare("SELECT * FROM trainings WHERE user_id = ? ORDER BY created_at DESC");
    $stmt->execute([$userId]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function createTraining() {
    if (!isset($_SESSION['user'])) {
        $_SESSION['toast'] = ['type' => 'danger', 'message' => 'Usuário não autenticado!'];
        header("Location: ../public/login.php");
        exit;
    }

    $userId = $_SESSION['user']['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    $pdo = getDatabaseConnection();

    $stmt = $pdo->prepare("INSERT INTO trainings (user_id, name, description) VALUES (?, ?, ?)");
    
    if ($stmt->execute([$userId, $name, $description])) {
        $_SESSION['toast'] = ['type' => 'success', 'message' => 'Treino criado com sucesso!'];
    } else {
        $_SESSION['toast'] = ['type' => 'danger', 'message' => 'Erro ao criar treino.'];
    }

    header("Location: ../public/dashboard.php");
}

function deleteTraining() {
    if (!isset($_SESSION['user'])) {
        $_SESSION['toast'] = ['type' => 'danger', 'message' => 'Usuário não autenticado!'];
        header("Location: ../public/login.php");
        exit;
    }

    $trainingId = $_POST['id'];
    $pdo = getDatabaseConnection();

    $stmt = $pdo->prepare("DELETE FROM trainings WHERE id = ?");
    
    if ($stmt->execute([$trainingId])) {
        $_SESSION['toast'] = ['type' => 'success', 'message' => 'Treino excluído com sucesso!'];
    } else {
        $_SESSION['toast'] = ['type' => 'danger', 'message' => 'Erro ao excluir treino.'];
    }

    header("Location: ../public/dashboard.php");
}


function getTrainingById($trainingId, $userId) {
    $pdo = getDatabaseConnection();

    $stmt = $pdo->prepare("SELECT * FROM trainings WHERE id = ? AND user_id = ?");
    $stmt->execute([$trainingId, $userId]);

    $training = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$training) {
        $_SESSION['toast'] = ['type' => 'danger', 'message' => 'Treino não encontrado.'];
        header("Location: ../public/dashboard.php");
        exit;
    }

    return $training;
}


