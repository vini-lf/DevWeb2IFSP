<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["imagem"])) {
    
    $pasta_destino = "imagens/";
    $nome_arquivo_original = basename($_FILES["imagem"]["name"]);
    $novo_nome_arquivo = uniqid() . '_' . $nome_arquivo_original;
    $caminho_completo = $pasta_destino . $novo_nome_arquivo;
    
    if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminho_completo)) {
        
        $sql = "INSERT INTO imagens (nome_arquivo) VALUES (?)";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("s", $novo_nome_arquivo);
        
        if ($stmt->execute()) {
            echo "Imagem enviada e registrada com sucesso!";
        } else {
            echo "Erro ao registrar a imagem no banco de dados.";
        }
        $stmt->close();
    } else {
        echo "Erro ao fazer o upload da imagem.";
    }
}

$conexao->close();

header("Location: index.php");
exit();
?>