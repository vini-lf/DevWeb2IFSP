<?php
include 'db.php';

$nome_completo = $_POST['nome_completo'];
$usuario = $_POST['usuario'];
$email = $_POST['email'];
$data_nascimento = $_POST['data_nascimento'];
$cpf = $_POST['cpf'];
$senha = $_POST['senha'];

$senha_hash = password_hash($senha, PASSWORD_DEFAULT); 

$sql = "INSERT INTO usuarios (nome_completo, usuario, email, data_nascimento, cpf, senha) VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Erro ao preparar a consulta: " . $conn->error);
}

$stmt->bind_param("ssssss", $nome_completo, $usuario, $email, $data_nascimento, $cpf, $senha_hash);

if ($stmt->execute()) {
    header("Location: cadastro_usuario.php?sucesso=1");
} else {
    header("Location: cadastro_usuario.php?erro=1");
}

$stmt->close();
$conn->close();
?>