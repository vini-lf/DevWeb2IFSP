<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senhaInput = $_POST['senha'];

    $stmt = $pdo->prepare("SELECT id, nome, senha_hash FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        if (password_verify($senhaInput, $usuario['senha_hash'])) {
            $_SESSION['user_id'] = $usuario['id'];
            $_SESSION['user_name'] = $usuario['nome'];
            echo "Login realizado com sucesso! Bem-vindo, " . $usuario['nome'];
        } else {
            echo "Senha incorreta.";
        }
    } else {
        echo "Usuário não encontrado.";
    }
}
?>
<form method="POST">
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="senha" placeholder="Senha">
    <button type="submit">Entrar</button>
</form>