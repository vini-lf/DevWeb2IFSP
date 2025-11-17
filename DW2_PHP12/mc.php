<?php
require_once 'db.php';

$stmt = $pdo->prepare("UPDATE memoria_calculadora SET valor = 0 WHERE id = ?");
$stmt->execute([MEMORIA_ID]);

echo json_encode(['status' => 'Memória limpa', 'novo_valor' => 0]);
?>