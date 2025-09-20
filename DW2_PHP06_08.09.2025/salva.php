<?php
session_start();

if (!isset($_SESSION['tarefas'])) {
    $_SESSION['tarefas'] = array();
}

$nome = $_POST['nome'];
$data = $_POST['data'];

$tarefa = array(
    "id" => uniqid(),
    "nome" => $nome,
    "data" => $data
);

array_push($_SESSION['tarefas'], $tarefa);

header("Location: lista.php?filtro=todas");
exit();
?>