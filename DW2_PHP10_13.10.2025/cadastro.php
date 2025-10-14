<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $cpf = $_POST['cpf'];
    $nascimento = $_POST['nascimento'];

    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nome, email, senha, cpf, nascimento) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$nome, $email, $senha_hash, $cpf, $nascimento])) {
        echo "Cadastro realizado com sucesso! Você será redirecionado para o login.";
        header("Refresh: 2; URL=login.php");
        exit();
    } else {
        echo "Erro ao cadastrar.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
</head>
<body>
    <h2>Cadastro de Cidadão</h2>
    <form method="POST">
        <p>Nome: <input type="text" name="nome" required></p>
        <p>Email: <input type="email" name="email" required></p>
        <p>Senha: <input type="password" name="senha" required></p>
        <p>CPF: <input type="text" name="cpf" required></p>
        <p>Data de Nascimento: <input type="date" name="nascimento" required></p>
        <button type="submit">Cadastrar</button>
    </form>
    <p>Já tem uma conta? <a href="login.php">Faça login</a></p>
</body>
</html>