<?php
include 'auth_check.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Enviar Submissão</title>
</head>
<body>
    <?php include 'menu.php'; ?>
    
    <h1>Enviar Novo Texto</h1>
     
    <?php
    if (isset($_GET['erro'])) {
        $erro = $_GET['erro'];
        if ($erro == 'tipo') {
            echo '<p style="color:red;">Erro: Apenas arquivos .pdf e .txt são permitidos.</p>';
        } elseif ($erro == 'upload') {
            echo '<p style="color:red;">Erro ao fazer upload do arquivo.</p>';
        }
    }
    ?>

    <form action="salva_submissao.php" method="POST" enctype="multipart/form-data">
        <p>
            <label for="titulo">Título do Trabalho:</label>
            <input type="text" id="titulo" name="titulo" required>
        </p>
        <p>
            <label for="observacoes">Observações:</label><br>
            <textarea id="observacoes" name="observacoes" rows="5" cols="40"></textarea>
        </p>
        <p>
            <label for="arquivo">Arquivo (Apenas .pdf ou .txt):</label>
            <input type="file" id="arquivo" name="arquivo" accept=".pdf,.txt" required>
        </p>
        <button type="submit">Enviar</button>
    </form>

</body>
</html>