<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: entrada.php?erro=autenticacao");
    exit;
}

$usuario_logado_id = $_SESSION['usuario_id'];
$usuario_logado_nome = $_SESSION['usuario_nome'];
?> 