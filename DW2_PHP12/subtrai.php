<?php
header('Content-Type: application/json');
$x = (float)($_GET['x'] ?? 0);
$y = (float)($_GET['y'] ?? 0);
$sub = $x - $y;
echo json_encode(['resultado' => $sub]);
?>