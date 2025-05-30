<?php
header('Content-Type: application/json');

// Apenas aceita POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['message' => 'Método inválido.']);
    exit;
}

// Dados recebidos do formulário
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

// Verificação básica
if (!$email || !$senha) {
    echo json_encode(['message' => 'Email e senha são obrigatórios.']);
    exit;
}

// Conexão com o banco
$host = '127.0.0.1';
$db   = 'carranca_db';
$user = 'root';
$pass = 'admin098@!';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    $hash = password_hash($senha, PASSWORD_DEFAULT);

    // COLOCA AAS INFO NO BANCO
    $stmt = $pdo->prepare("INSERT INTO usuarios (email, senha) VALUES (:email, :senha)");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $hash); // ou use $senha direto (menos seguro)

    $stmt->execute();

    echo json_encode(['message' => 'Registro efetuado com sucesso!']);
} catch (PDOException $e) {
    echo json_encode(['message' => 'Erro no banco: ' . $e->getMessage()]);
}
?>
