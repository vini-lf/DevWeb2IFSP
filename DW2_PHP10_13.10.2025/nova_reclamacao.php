<?php
require 'config.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $id_reclamante = $_SESSION['usuario_id'];
    $caminho_foto = "";

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $diretorio = "uploads/";
        $nome_arquivo = uniqid() . '_' . basename($_FILES['foto']['name']);
        $caminho_foto = $diretorio . $nome_arquivo;

        if (!move_uploaded_file($_FILES['foto']['tmp_name'], $caminho_foto)) {
            $caminho_foto = "";
        }
    }

    $sql = "INSERT INTO reclamacao (id_reclamante, titulo, descricao, foto) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_reclamante, $titulo, $descricao, $caminho_foto]);

    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Nova Reclamação</title>
</head>
<body>
    <h2>Fazer Nova Reclamação</h2>
    <form method="POST" enctype="multipart/form-data">
        <p>Título: <input type="text" name="titulo" required></p>
        <p>Descrição:<br><textarea name="descricao" rows="5" cols="40" required></textarea></p>
        <p>Foto (opcional): <input type="file" name="foto"></p>
        <button type="submit">Enviar</button>
    </form>
    <p><a href="index.php">Voltar</a></p>
</body>
</html>