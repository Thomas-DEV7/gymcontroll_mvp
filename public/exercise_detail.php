<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

require_once '../controllers/ExerciseController.php';
require_once '../controllers/ExecutionController.php';

$exerciseId = $_GET['id'] ?? null;

if (!$exerciseId) {
    $_SESSION['toast'] = ['type' => 'danger', 'message' => 'Exercício não encontrado!'];
    header('Location: dashboard.php');
    exit;
}

$exercise = getExerciseById($exerciseId);
$executions = getExecutionsByExercise($exerciseId);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Detalhe do Exercício - GymControll</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body { background-color: #121212; color: #ffffff; }
        .navbar { background-color: #1f1f1f; }
        .card { background-color: #1f1f1f; border-radius: 12px; margin-bottom: 20px; color: #ffffff;}
        .btn-create { background-color: #6200EE; color: #fff; }
        .btn-create:hover { background-color: #3700B3; }
        .btn-logout { background-color: #ff4d4d; }
        .btn-logout:hover { background-color: #ff1a1a; }
    </style>
</head>
<body>

<nav class="navbar navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="training_detail.php?id=<?= $exercise['training_id'] ?>">GymControll</a>
        <div>
            <span class="me-3">Olá, <?= htmlspecialchars($_SESSION['user']['name']) ?></span>
            <a href="../controllers/AuthController.php?action=logout" class="btn btn-sm btn-logout">Sair</a>
        </div>
    </div>
</nav>

<div class="container py-4">
    <?php include '../toasts/toast.php'; ?>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2><?= htmlspecialchars($exercise['name']) ?></h2>
            <p><?= htmlspecialchars($exercise['description']) ?></p>
        </div>
        <button class="btn btn-create" data-bs-toggle="modal" data-bs-target="#addExecutionModal">+ Execução</button>
    </div>

    <!-- Gráfico de Progressão -->
    <div class="card p-3">
        <h5 class="mb-3">Evolução de Carga</h5>
        <canvas id="progressChart"></canvas>
    </div>

    <!-- Histórico de Execuções -->
    <div class="card p-3">
        <h5 class="mb-3">Histórico de Execuções</h5>
        <div class="table-responsive">
            <table class="table table-dark table-hover align-middle">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Carga (kg)</th>
                        <th>Repetições</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($executions) > 0): ?>
                        <?php foreach ($executions as $execution): ?>
                            <tr>
                                <td><?= date("d/m/Y", strtotime($execution['execution_date'])) ?></td>
                                <td><?= $execution['weight'] ?> kg</td>
                                <td><?= $execution['repetitions'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="3" class="text-center">Nenhuma execução registrada ainda.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Adicionar Execução -->
<div class="modal fade" id="addExecutionModal" tabindex="-1" aria-labelledby="addExecutionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="../controllers/ExecutionController.php?action=create" method="POST" class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h5 class="modal-title" id="addExecutionModalLabel">Nova Execução</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="exercise_id" value="<?= $exerciseId ?>">
                <div class="mb-3">
                    <label class="form-label">Carga (kg)</label>
                    <input type="number" name="weight" class="form-control bg-dark text-white" step="0.1" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Repetições</label>
                    <input type="number" name="repetitions" class="form-control bg-dark text-white" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success w-100">Registrar Execução</button>
            </div>
        </form>
    </div>
</div>

<script>
    const executionData = <?= json_encode($executions) ?>;
    
    const labels = executionData.map(ex => new Date(ex.execution_date).toLocaleDateString());
    const weights = executionData.map(ex => ex.weight);

    const ctx = document.getElementById('progressChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Carga (kg)',
                data: weights,
                borderColor: '#6200EE',
                backgroundColor: 'rgba(98, 0, 238, 0.2)',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
