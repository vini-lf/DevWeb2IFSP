<?php
session_start();
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];

 
    $sql = "SELECT id, nome, senha FROM usuarios WHERE nome = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome]);
    $usuario = $stmt->fetch();

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        
        $_SESSION['id'] = $usuario['id'];
        $_SESSION['nome'] = $usuario['nome'];
        header('Location: tarefas.php');
        exit;
    } else {
        $erro = "Usuário ou senha incorretos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if (isset($erro)): ?>
        <p style="color:red;"><?php echo $erro; ?></p>
    <?php endif; ?>
    <form action="login.php" method="post">
        <label>Nome de Usuário:</label><br>
        <input type="text" name="nome" required><br>
        <label>Senha:</label><br>
        <input type="password" name="senha" required><br><br>
        <button type="submit">Entrar</button>
    </form>
    <p>Ainda não tem cadastro? <a href="cadastro.php">Cadastre-se aqui!</a></p>
</body>
</html>