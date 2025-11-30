<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha_hash) VALUES (?, ?, ?)");
    
    try {
        $stmt->execute([$nome, $email, $senhaCriptografada]);
        echo "Usuário cadastrado com sucesso!";
    } catch (PDOException $e) {
        echo "Erro: Email já cadastrado.";
    }
}
?>
<form method="POST">
    <input type="text" name="nome" placeholder="Nome" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="senha" placeholder="Senha" required>
    <button type="submit">Cadastrar</button>
</form> 