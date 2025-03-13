<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

require_once '../controllers/TrainingController.php';
require_once '../controllers/ExerciseController.php';

$trainings = getUserTrainings($_SESSION['user']['id']);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Dashboard - GymControll</title>
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

    <nav class="navbar navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">GymControll</a>
            <div>
                <span class="me-3">Olá, <?= htmlspecialchars($_SESSION['user']['name']) ?></span>
                <a href="../controllers/AuthController.php?action=logout" class="btn btn-sm btn-logout">Sair</a>
            </div>
        </div>
    </nav>

    <div class="container py-4">

        <?php include '../toasts/toast.php'; ?>

        <!-- Botão de criar treino -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Meus Treinos</h2>
            <button class="btn btn-create" data-bs-toggle="modal" data-bs-target="#createTrainingModal">+ Novo Treino</button>
        </div>

        <!-- Lista de treinos -->
        <div class="row">
            <?php if (count($trainings) > 0): ?>
                <?php foreach ($trainings as $training): ?>
                    <div class="col-md-4 col-sm-6 mb-3">
                        <div class="card p-3">
                            <h5><?= htmlspecialchars($training['name']) ?></h5>
                            <p><?= htmlspecialchars($training['description']) ?></p>
                            <div class="d-flex justify-content-between">
                                <a href="training_detail.php?id=<?= $training['id'] ?>" class="btn btn-success btn-sm">Ver Exercícios</a>
                                <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?= $training['id'] ?>)">Excluir</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info text-center">Nenhum treino cadastrado ainda.</div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal Criar Treino -->
    <div class="modal fade" id="createTrainingModal" tabindex="-1" aria-labelledby="createTrainingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="../controllers/TrainingController.php?action=create" method="POST" class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="createTrainingModalLabel">Novo Treino</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="training_name" class="form-label">Nome do Treino</label>
                        <input type="text" class="form-control bg-dark text-white" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="training_description" class="form-label">Descrição</label>
                        <textarea class="form-control bg-dark text-white" name="description"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success w-100">Criar Treino</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Formulário para excluir treino -->
    <form id="deleteTrainingForm" action="../controllers/TrainingController.php?action=delete" method="POST" style="display: none;">
        <input type="hidden" name="id" id="deleteTrainingId">
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function confirmDelete(trainingId) {
            if (confirm("Tem certeza que deseja excluir este treino?")) {
                document.getElementById('deleteTrainingId').value = trainingId;
                document.getElementById('deleteTrainingForm').submit();
            }
        }
    </script>
</body>

</html>