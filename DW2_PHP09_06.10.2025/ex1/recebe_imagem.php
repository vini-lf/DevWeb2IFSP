<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Imagem</title>
</head>
<body>
    <form action="salva_fotos.php" method="post" enctype="multipart/form-data">
        <label for="imagem">Selecione uma imagem:</label>
        <br>
        <input type="file" name="figura" id="imagem">
        <br><br>
        
        <input type="submit" value="Enviar">
    </form>
</body>
</html>