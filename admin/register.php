<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['message' => 'Método inválido.']);
    exit;
}

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';
$confirmarSenha = $_POST['confirmarSenha'] ?? '';

if (!$email || !$senha || !$confirmarSenha) {
    echo json_encode(['message' => 'Email, senha e confirmação são obrigatórios.']);
    exit;
}

if ($senha !== $confirmarSenha) {
    echo json_encode(['message' => 'As senhas não coincidem.']);
    exit;
}

$host = '127.0.0.1';
$db   = 'carranca_db';
$user = 'root';
$pass = 'admin098@!';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verifica se o e-mail já existe
    $check = $pdo->prepare("SELECT id FROM usuarios WHERE email = :email");
    $check->bindParam(':email', $email);
    $check->execute();

    if ($check->rowCount() > 0) {
        echo json_encode(['message' => 'Este e-mail já está registrado.']);
        exit;
    }

    $hash = password_hash($senha, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO usuarios (email, senha) VALUES (:email, :senha)");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $hash);

    $stmt->execute();

    echo json_encode(['message' => 'Registro efetuado com sucesso!']);
} catch (PDOException $e) {
    echo json_encode(['message' => 'Erro no banco: ' . $e->getMessage()]);
}
?>
