<?php
require_once 'db.php';

$valor = (float)($_GET['valor'] ?? 0);

// Atualiza o valor no banco subtraindo o novo valor
$stmt = $pdo->prepare("UPDATE memoria_calculadora SET valor = valor - ? WHERE id = ?");
$stmt->execute([$valor, MEMORIA_ID]);

// Retorna o novo valor da memória
$stmt = $pdo->prepare("SELECT valor FROM memoria_calculadora WHERE id = ?");
$stmt->execute([MEMORIA_ID]);
$memoria = $stmt->fetch();

echo json_encode(['status' => 'Valor subtraído', 'novo_valor' => $memoria['valor']]);
?>