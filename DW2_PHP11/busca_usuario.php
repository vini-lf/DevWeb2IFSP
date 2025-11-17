<?php
include 'db.php';
session_start();

$login = $_POST['login'];
$senha_form = $_POST['senha'];

$sql = "SELECT id, usuario, senha FROM usuarios WHERE usuario = ? OR email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $login, $login);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $usuario = $resultado->fetch_assoc();

    if (password_verify($senha_form, $usuario['senha'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['usuario'];
        
        header("Location: submissoes.php");
        exit;
    }
}
 
header("Location: entrada.php?erro=login");
exit;

$stmt->close();
$conn->close();
?>