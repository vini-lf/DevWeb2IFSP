<?php
header('Content-Type: application/json');
$x = (float)($_GET['x'] ?? 0);

if ($x < 0) {
    echo json_encode(['erro' => 'Raiz de número negativo']);
} else {
    $raiz = sqrt($x);
    echo json_encode(['resultado' => $raiz]);
}
?>