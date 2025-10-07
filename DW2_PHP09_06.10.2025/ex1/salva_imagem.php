<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado do Envio</title>
</head>
<body>
    <?php
    if (isset($_FILES['figura']) && $_FILES['figura']['error'] == 0) {
        
        $nome_arquivo = $_FILES['figura']['name'];
        $caminho_temporario = $_FILES['figura']['tmp_name'];
        $pasta_destino = 'fotos/';
        $destino_final = $pasta_destino . $nome_arquivo;
        $resultado = move_uploaded_file($caminho_temporario, $destino_final);

        if ($resultado) {
            echo "<p>Arquivo $nome_arquivo movido para a pasta fotos com sucesso!</p>";

            echo "<img src='$destino_final' width='300px'>";
        } else {
            echo "<p>Erro ao mover o arquivo para o destino!</p>";
        }

    } else {
        echo "<p>Erro no envio: Nenhum arquivo recebido.</p>";
    }
    ?>
    <br><br>
</body>
</html>