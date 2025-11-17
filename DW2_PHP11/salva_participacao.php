<?php
include 'auth_check.php';
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: atividades.php");
    exit;
}

$atividade_id = (int)$_POST['atividade_id'];
$usuario_id = $usuario_logado_id; 
$comentario = $_POST['comentario'];

if ($atividade_id > 0 && !empty($comentario)) {
    $sql = "INSERT INTO participacoes (atividade_id, usuario_id, comentario, data_participacao) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $atividade_id, $usuario_id, $comentario);
    $stmt->execute();
    $stmt->close();
}

$conn->close();

header("Location: participa_atividade.php?id=" . $atividade_id);
exit;
?>