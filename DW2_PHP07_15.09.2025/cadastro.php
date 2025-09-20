<?php
include 'conexao.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $nascimento = $_POST['nascimento'] ?? NULL; 
    $numero = $_POST['numero'];
    $cep = $_POST['cep'] ?? NULL;
    $numero = $_POST['numero'] ?? NULL;

$sql = "INSERT INTO usuarios (nome, senha, nascimento, cep, numero) VALUES (?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$nome, $senha, $nascimento, $cep, $numero]);

    echo "Usuário cadastrado com sucesso!";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>
</head>
<body>
    <h2>Cadastro de Usuário</h2>
    <form action="cadastro.php" method="post">
        <label>Nome:</label><br>
        <input type="text" name="nome" required><br>
        <label>Senha:</label><br>
        <input type="password" name="senha" required><br>
        <label>Data de Nascimento:</label><br>
        <input type="date" name="nascimento"><br>
        <label>CEP:</label><br>
        <input type="text" name="cep"><br>
        <label>Número:</label><br>
        <input type="text" name="numero"><br><br>
        <button type="submit">Cadastrar</button>
    </form>
    <p>Já tem cadastro? <a href="login.php">Faça login aqui!</a></p>
</body>
</html>