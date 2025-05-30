<?php
session_start();
require 'conexao.php';

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] !== 'admin') {
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'Acesso negado.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $conteudo = $_POST['conteudo'];

    $sql = "INSERT INTO noticias (titulo, conteudo, data) VALUES (?, ?, NOW())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$titulo, $conteudo]);

    echo json_encode(['status' => 'success', 'message' => 'Notícia adicionada!']);
}
?>
