<?php
include 'auth_check.php';
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: atividades.php");
    exit;
}

$titulo = $_POST['titulo'];
$comentario = $_POST['comentario'];
$usuario_id = $usuario_logado_id;
 
$sql = "INSERT INTO atividades (usuario_id, titulo, comentario, data_criacao) VALUES (?, ?, ?, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $usuario_id, $titulo, $comentario);

$stmt->execute();
$stmt->close();
$conn->close();

header("Location: atividades.php");
exit;
?>