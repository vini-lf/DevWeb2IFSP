<?php

$host = 'localhost';
$db   = 'nome_do_seu_banco';
$user = 'seu_usuario';
$pass = 'sua_senha';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     http_response_code(500);
     echo json_encode(['erro' => 'Falha na conexão com o banco: ' . $e->getMessage()]);
     exit; 
}


define('MEMORIA_ID', 1);


header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); 
?>