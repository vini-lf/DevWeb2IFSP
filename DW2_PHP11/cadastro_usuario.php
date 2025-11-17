<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro - Clube de Escrita</title>
</head>
<body>
    <h1>Cadastro de Novo Usuário</h1>
    
    <?php
    if (isset($_GET['erro'])) {
        echo '<p style="color:red;">Ocorreu um erro. Verifique se o usuário, e-mail ou CPF já existem.</p>';
    }
    if (isset($_GET['sucesso'])) {
        echo '<p style="color:green;">Cadastro realizado com sucesso! Faça o login.</p>';
    }
    ?>
 
    <form action="salva_usuario.php" method="POST">
        <p>
            <label for="nome_completo">Nome Completo:</label>
            <input type="text" id="nome_completo" name="nome_completo" required>
        </p>
        <p>
            <label for="usuario">Usuário (Apelido):</label>
            <input type="text" id="usuario" name="usuario" required>
        </p>
        <p>
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>
        </p>
        <p>
            <label for="data_nascimento">Data de Nascimento:</label>
            <input type="date" id="data_nascimento" name="data_nascimento" required>
        </p>
        <p>
            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" required>
        </p>
        <p>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
        </p>
        <button type="submit">Cadastrar</button>
    </form>
    
    <p><a href="entrada.php">Já tem conta? Faça login</a></p>

</body>
</html>