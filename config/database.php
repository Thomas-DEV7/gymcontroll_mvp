<?php
function getDatabaseConnection() {
    $host = 'localhost';
    $dbname = 'gymcontroll';
    $username = 'root';
    $password = ''; // senha padrão do XAMPP

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Erro na conexão: " . $e->getMessage());
    }
}
