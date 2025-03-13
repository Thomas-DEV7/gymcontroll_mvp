<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../config/database.php';

$action = $_GET['action'] ?? '';

if ($action === 'create') {
    createExercise();
} elseif ($action === 'delete') {
    deleteExercise();
}

function getExercisesByTraining($trainingId) {
    $pdo = getDatabaseConnection();

    $stmt = $pdo->prepare("SELECT * FROM exercises WHERE training_id = ? ORDER BY created_at DESC");
    $stmt->execute([$trainingId]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getExerciseById($exerciseId) {
    $pdo = getDatabaseConnection();

    $stmt = $pdo->prepare("SELECT * FROM exercises WHERE id = ?");
    $stmt->execute([$exerciseId]);

    $exercise = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$exercise) {
        $_SESSION['toast'] = ['type' => 'danger', 'message' => 'Exercício não encontrado.'];
        header("Location: ../public/dashboard.php");
        exit;
    }

    return $exercise;
}


function createExercise() {
    if (!isset($_SESSION['user'])) {
        $_SESSION['toast'] = ['type' => 'danger', 'message' => 'Usuário não autenticado!'];
        header("Location: ../public/login.php");
        exit;
    }

    $trainingId = $_POST['training_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    $pdo = getDatabaseConnection();

    $stmt = $pdo->prepare("INSERT INTO exercises (training_id, name, description) VALUES (?, ?, ?)");
    
    if ($stmt->execute([$trainingId, $name, $description])) {
        $_SESSION['toast'] = ['type' => 'success', 'message' => 'Exercício adicionado com sucesso!'];
    } else {
        $_SESSION['toast'] = ['type' => 'danger', 'message' => 'Erro ao adicionar exercício.'];
    }

    header("Location: ../public/training_detail.php?id=" . $trainingId);
}

function deleteExercise() {
    if (!isset($_SESSION['user'])) {
        $_SESSION['toast'] = ['type' => 'danger', 'message' => 'Usuário não autenticado!'];
        header("Location: ../public/login.php");
        exit;
    }

    $exerciseId = $_POST['id'];
    $trainingId = $_POST['training_id'];

    $pdo = getDatabaseConnection();

    $stmt = $pdo->prepare("DELETE FROM exercises WHERE id = ?");
    
    if ($stmt->execute([$exerciseId])) {
        $_SESSION['toast'] = ['type' => 'success', 'message' => 'Exercício excluído com sucesso!'];
    } else {
        $_SESSION['toast'] = ['type' => 'danger', 'message' => 'Erro ao excluir exercício.'];
    }

    header("Location: ../public/training_detail.php?id=" . $trainingId);
}
