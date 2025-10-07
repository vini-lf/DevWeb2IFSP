<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id_imagem = (int)$_GET['id'];

    $sql = "UPDATE imagens SET curtidas = curtidas + 1 WHERE id = ?";
    
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id_imagem);
    $stmt->execute();
    $stmt->close();
}

$conexao->close();

header("Location: index.php");
exit();
?>