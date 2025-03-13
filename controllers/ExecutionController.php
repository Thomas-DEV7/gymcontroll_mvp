<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../config/database.php';

$action = $_GET['action'] ?? '';

if ($action === 'create') {
    createExecution();
}

function getExecutionsByExercise($exerciseId) {
    $pdo = getDatabaseConnection();

    $stmt = $pdo->prepare("SELECT * FROM executions WHERE exercise_id = ? ORDER BY execution_date ASC");
    $stmt->execute([$exerciseId]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function createExecution() {
    if (!isset($_SESSION['user'])) {
        $_SESSION['toast'] = ['type' => 'danger', 'message' => 'Usuário não autenticado!'];
        header("Location: ../public/login.php");
        exit;
    }

    $exerciseId = $_POST['exercise_id'];
    $weight = $_POST['weight'];
    $repetitions = $_POST['repetitions'];

    $pdo = getDatabaseConnection();

    $stmt = $pdo->prepare("INSERT INTO executions (exercise_id, weight, repetitions) VALUES (?, ?, ?)");
    
    if ($stmt->execute([$exerciseId, $weight, $repetitions])) {
        $_SESSION['toast'] = ['type' => 'success', 'message' => 'Execução registrada com sucesso!'];
    } else {
        $_SESSION['toast'] = ['type' => 'danger', 'message' => 'Erro ao registrar execução.'];
    }

    header("Location: ../public/exercise_detail.php?id=" . $exerciseId);
}
