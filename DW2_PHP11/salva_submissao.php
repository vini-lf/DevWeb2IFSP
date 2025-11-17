<?php
include 'auth_check.php';
include 'db.php';

$diretorio_upload = "uploads/";

$titulo = $_POST['titulo'];
$observacoes = $_POST['observacoes'];
$usuario_id = $usuario_logado_id; 

$arquivo_tmp = $_FILES['arquivo']['tmp_name'];
$arquivo_erro = $_FILES['arquivo']['error'];

$arquivo_nome_original = $_FILES['arquivo']['name'];
 
if ($arquivo_erro !== UPLOAD_ERR_OK) {
    header("Location: envia_submissao.php?erro=upload");
    exit;
}

$extensao = strtolower(pathinfo($arquivo_nome_original, PATHINFO_EXTENSION));
if ($extensao != 'pdf' && $extensao != 'txt') {
    header("Location: envia_submissao.php?erro=tipo");
    exit;
}

$arquivo_nome_novo = uniqid('sub_', true) . '.' . $extensao;
$caminho_completo = $diretorio_upload . $arquivo_nome_novo;

if (move_uploaded_file($arquivo_tmp, $caminho_completo)) {

    $sql = "INSERT INTO submissoes (usuario_id, titulo, observacoes, arquivo, arquivo_original, data_submissao) VALUES (?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    
    $stmt->bind_param("issss", $usuario_id, $titulo, $observacoes, $arquivo_nome_novo, $arquivo_nome_original);
    
    if ($stmt->execute()) {
        header("Location: minhas_submissoes.php");
        exit;
    } else {
        unlink($caminho_completo);
        header("Location: envia_submissao.php?erro=db");
        exit;
    }
    $stmt->close();
} else {
    header("Location: envia_submissao.php?erro=upload");
    exit;
}

$conn->close();
?>