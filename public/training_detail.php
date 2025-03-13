<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

require_once '../controllers/TrainingController.php';
require_once '../controllers/ExerciseController.php';

$trainingId = $_GET['id'] ?? null;

if (!$trainingId) {
    $_SESSION['toast'] = ['type' => 'danger', 'message' => 'Treino não informado!'];
    header('Location: dashboard.php');
    exit;
}

$training = getTrainingById($trainingId, $_SESSION['user']['id']);
$exercises = getExercisesByTraining($trainingId);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Treino - GymControll</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #121212;
            color: #ffffff;
        }

        .navbar {
            background-color: #1f1f1f;
        }

        .card {
            background-color: #1f1f1f;
            color: #ffffff;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .btn-create {
            background-color: #6200EE;
            color: #fff;
        }

        .btn-create:hover {
            background-color: #3700B3;
        }

        .btn-logout {
            background-color: #ff4d4d;
        }

        .btn-logout:hover {
            background-color: #ff1a1a;
        }
    </style>
</head>

<body>

    <?php
    include '../includes/header.php';
    ?>



    <div class="container py-4">

        <?php include '../toasts/toast.php'; ?>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h2><?= htmlspecialchars($training['name']) ?></h2>
                <p><?= htmlspecialchars($training['description']) ?></p>
            </div>
            <button class="btn btn-create" data-bs-toggle="modal" data-bs-target="#createExerciseModal">+ Exercício</button>
        </div>

        <div class="row">
            <?php if (count($exercises) > 0): ?>
                <?php foreach ($exercises as $exercise): ?>
                    <div class="col-md-4 col-sm-6 mb-3">
                        <div class="card p-3">
                            <h5><?= htmlspecialchars($exercise['name']) ?></h5>
                            <p><?= htmlspecialchars($exercise['description']) ?></p>
                            <div class="d-flex justify-content-between">
                                <a href="exercise_detail.php?id=<?= $exercise['id'] ?>" class="btn btn-success btn-sm">Ver Execuções</a>
                                <button class="btn btn-danger btn-sm" onclick="confirmDeleteExercise(<?= $exercise['id'] ?>)">Excluir</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info text-center">Nenhum exercício cadastrado neste treino.</div>
                </div>
            <?php endif; ?>
        </div>

    </div>

    <!-- Modal Criar Exercício -->
    <div class="modal fade" id="createExerciseModal" tabindex="-1" aria-labelledby="createExerciseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="../controllers/ExerciseController.php?action=create" method="POST" class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="createExerciseModalLabel">Novo Exercício</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="training_id" value="<?= $trainingId ?>">
                    <div class="mb-3">
                        <label for="exercise_name" class="form-label">Nome do Exercício</label>
                        <input type="text" class="form-control bg-dark text-white" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="exercise_description" class="form-label">Descrição</label>
                        <textarea class="form-control bg-dark text-white" name="description"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success w-100">Adicionar Exercício</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Formulário para excluir exercício -->
    <form id="deleteExerciseForm" action="../controllers/ExerciseController.php?action=delete" method="POST" style="display: none;">
        <input type="hidden" name="id" id="deleteExerciseId">
        <input type="hidden" name="training_id" value="<?= $trainingId ?>">
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function confirmDeleteExercise(exerciseId) {
            if (confirm("Tem certeza que deseja excluir este exercício?")) {
                document.getElementById('deleteExerciseId').value = exerciseId;
                document.getElementById('deleteExerciseForm').submit();
            }
        }
    </script>

</body>

</html>