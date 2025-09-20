<?php
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (isset($_SESSION['tarefas'])) {
        $_SESSION['tarefas'] = array_filter($_SESSION['tarefas'], function($t) use ($id) {
            return $t['id'] !== $id;
        });
    }
}

header("Location: lista.php?filtro=todas");
exit();
?>