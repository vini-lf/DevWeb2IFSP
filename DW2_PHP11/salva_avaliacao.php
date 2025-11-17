<?php
include 'auth_check.php';
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: submissoes.php");
    exit;
}

$submissao_id = (int)$_POST['submissao_id'];
$usuario_id = $usuario_logado_id;
$aprovado = (int)$_POST['aprovado'];
$comentario = $_POST['comentario']; 

$sql_check = "SELECT usuario_id FROM submissoes WHERE id = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("i", $submissao_id);
$stmt_check->execute();
$sub_check = $stmt_check->get_result()->fetch_assoc();

if ($sub_check && $sub_check['usuario_id'] == $usuario_id) {
    header("Location: minhas_submissoes.php");
    exit;
}
$stmt_check->close();

$sql = "INSERT INTO avaliacoes (submissao_id, usuario_id, aprovado, comentario, data_avaliacao) VALUES (?, ?, ?, ?, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiis", $submissao_id, $usuario_id, $aprovado, $comentario);

$stmt->execute();
$stmt->close();
$conn->close();

header("Location: avalia_submissao.php?id=" . $submissao_id);
exit;
?>