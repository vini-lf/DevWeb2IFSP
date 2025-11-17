<?php
session_start();
if (isset($_SESSION['usuario_id'])) {
    header("Location: submissoes.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Clube de Escrita</title>
</head>
<body> 
    <h1>Entrar no Clube de Escrita</h1>

    <?php
    if (isset($_GET['erro'])) {
        echo '<p style="color:red;">Usuário, e-mail ou senha incorretos, ou acesso negado.</p>';
    }
    ?>

    <form action="busca_usuario.php" method="POST">
        <p>
            <label for="login">Usuário ou E-mail:</label>
            <input type="text" id="login" name="login" required>
        </p>
        <p>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
        </p>
        <button type="submit">Entrar</button>
    </form>
    
    <p><a href="cadastro_usuario.php">Não tem conta? Cadastre-se</a></p>
</body>
</html>