<?php
require_once 'db.php';


$valor = (float)($_GET['valor'] ?? 0);


$stmt = $pdo->prepare("UPDATE memoria_calculadora SET valor = valor + ? WHERE id = ?");
$stmt->execute([$valor, MEMORIA_ID]);


$stmt = $pdo->prepare("SELECT valor FROM memoria_calculadora WHERE id = ?");
$stmt->execute([MEMORIA_ID]);
$memoria = $stmt->fetch();

echo json_encode(['status' => 'Valor somado', 'novo_valor' => $memoria['valor']]);
?>