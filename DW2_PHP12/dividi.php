<?php
header('Content-Type: application/json');
$x = (float)($_GET['x'] ?? 0);
$y = (float)($_GET['y'] ?? 0);

if ($y == 0) {
    echo json_encode(['erro' => 'Divisão por zero']);
} else {
    $div = $x / $y;
    echo json_encode(['resultado' => $div]);
}
?>