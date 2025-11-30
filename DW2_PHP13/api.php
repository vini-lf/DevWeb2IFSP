<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");

require 'db.php';

$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? '';

function response($data, $status = 200) {
    http_response_code($status);
    echo json_encode($data);
    exit;
}

if ($method === 'GET' && $action === 'listar') {
    $stmt = $pdo->query("SELECT * FROM produtos");
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    response($produtos);
}

if ($method === 'POST' && $action === 'novo') {
    $data = json_decode(file_get_contents("php://input"), true);
    
    $sql = "INSERT INTO produtos (nome, descricao, validade, quantidade, estoque_minimo, ultimo_preco) 
            VALUES (:nome, :descricao, :validade, :quantidade, :minimo, :preco)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nome' => $data['nome'],
        ':descricao' => $data['descricao'],
        ':validade' => $data['validade'],
        ':quantidade' => $data['quantidade'],
        ':minimo' => $data['minimo'],
        ':preco' => $data['preco']
    ]);
    
    response(['message' => 'Produto criado com sucesso']);
}

if ($method === 'POST' && $action === 'movimentar') {
    $data = json_decode(file_get_contents("php://input"), true);
    
    $id_produto = $data['id_produto'];
    $id_usuario = $data['id_usuario']; 
    
    $stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
    $stmt->execute([$id_produto]);
    $old = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $changes = [];
    if ($old['quantidade'] != $data['quantidade']) $changes[] = "Qtd: {$old['quantidade']} para {$data['quantidade']}";
    if ($old['ultimo_preco'] != $data['preco']) $changes[] = "Preço: {$old['ultimo_preco']} para {$data['preco']}";
    if ($old['validade'] != $data['validade']) $changes[] = "Validade: {$old['validade']} para {$data['validade']}";
    
    if (!empty($changes)) {
        $sqlUpdate = "UPDATE produtos SET quantidade = :qtd, ultimo_preco = :preco, validade = :val WHERE id = :id";
        $stmtUpdate = $pdo->prepare($sqlUpdate);
        $stmtUpdate->execute([
            ':qtd' => $data['quantidade'],
            ':preco' => $data['preco'],
            ':val' => $data['validade'],
            ':id' => $id_produto
        ]);
        
        $sqlLog = "INSERT INTO alteracoes (id_produto, id_usuario, alteracoes) VALUES (:idp, :idu, :alt)";
        $stmtLog = $pdo->prepare($sqlLog);
        $stmtLog->execute([
            ':idp' => $id_produto,
            ':idu' => $id_usuario,
            ':alt' => implode(", ", $changes)
        ]);
        
        response(['message' => 'Movimentação registrada']);
    } else {
        response(['message' => 'Nenhuma alteração detectada'], 400);
    }
}

response(['error' => 'Ação não encontrada'], 404);
?>