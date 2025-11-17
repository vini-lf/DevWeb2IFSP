<?php
require_once 'db.php';

$stmt = $pdo->prepare("SELECT valor FROM memoria_calculadora WHERE id = ?");
$stmt->execute([MEMORIA_ID]);
$memoria = $stmt->fetch();

echo json_encode(['valor' => $memoria['valor']]);
?>