<?php
include 'db.php';

$sql = "SELECT id, nome_arquivo, curtidas FROM imagens ORDER BY curtidas DESC";
$resultado = $conexao->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
</head>
<body>

    <div class="upload-form">
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <input type="file" name="imagem" required>
            <input type="submit" value="Enviar Imagem">
        </form>
    </div>

    <div class="galeria">
        <?php
        if ($resultado->num_rows > 0) {
            while($img = $resultado->fetch_assoc()) {
        ?>
            <div class="foto">
                <img src="imagens/<?php echo htmlspecialchars($img['nome_arquivo']); ?>" alt="Imagem da galeria">
                <p>Curtidas: <?php echo $img['curtidas']; ?></p>
                <a href="curtir.php?id=<?php echo $img['id']; ?>" class="curtir-btn">Curtir 👍</a>
            </div>
        <?php
            }
        } else {
            echo "<p>Nenhuma imagem na galeria ainda. Seja o primeiro a enviar!</p>";
        }
        ?>
    </div>
</body>
</html>
<?php
$conexao->close();
?>