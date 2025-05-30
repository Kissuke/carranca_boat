<?php
session_start();
require 'conexao.php';

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] !== 'admin') {
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'Acesso negado.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['imagem'])) {
    $dir = 'uploads/';
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }

    $file = $dir . basename($_FILES['imagem']['name']);
    
    if (move_uploaded_file($_FILES['imagem']['tmp_name'], $file)) {
        $titulo = $_POST['titulo'];

        $sql = "INSERT INTO imagens (titulo, url, data) VALUES (?, ?, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$titulo, $file]);

        echo json_encode(['status' => 'success', 'message' => 'Imagem enviada!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Falha no upload.']);
    }
}
?>
