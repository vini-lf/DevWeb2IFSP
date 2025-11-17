<?php
header('Content-Type: application/json');
$x = (float)($_GET['x'] ?? 0);
$y = (float)($_GET['y'] ?? 0);
$mult = $x * $y;
echo json_encode(['resultado' => $mult]);
?>