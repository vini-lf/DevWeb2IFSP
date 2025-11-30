<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) die("Acesso negado.");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $textoHistorico = $_POST['historico_texto']; 
    
    $linhas = explode("\n", $textoHistorico);
    
    echo "<h3>Resumo do Processamento:</h3><ul>";

    foreach ($linhas as $linha) {
        $linha = trim($linha);
        if (empty($linha)) continue;

        $partes = explode("|", $linha);

        if (count($partes) >= 3) {
            $disciplina = trim($partes[0]);
            $nota = floatval(str_replace(',', '.', trim($partes[1])));
            $situacao = trim($partes[2]);

            $stmt = $pdo->prepare("INSERT INTO historicos (id_usuario, disciplina, nota, situacao) VALUES (?, ?, ?, ?)");
            $stmt->execute([$_SESSION['user_id'], $disciplina, $nota, $situacao]);

            $cor = (stripos($situacao, 'Aprovado') !== false) ? 'green' : 'red';
            echo "<li style='color:$cor'>$disciplina: $nota ($situacao)</li>";
        }
    }
    echo "</ul>";
    echo "<a href='dashboard.php'>Voltar ao Painel</a>";
}
?>