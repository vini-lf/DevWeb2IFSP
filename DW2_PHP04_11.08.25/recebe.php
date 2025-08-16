<?php
session_start();
require_once 'aluno.php';

$nome = $_POST['nome'];
$nascimento = $_POST['nascimento'];
$curso = $_POST['curso'];
$matricula = $_POST['matricula'];

$aluno = new Aluno($nome, $nascimento, $curso, $matricula);
$_SESSION['aluno'] = serialize($aluno);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aluno Cadastrado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'menu.php'; ?>

    <div class="container mt-4">
        <div class="alert alert-success" role="alert">
            Aluno cadastrado com sucesso!
        </div>
        
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#alunoModal">
            Mostrar Dados Cadastrados
        </button>
    </div>

    <div class="modal fade" id="alunoModal" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Dados do Aluno</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <p><strong>Nome:</strong> <?php echo htmlspecialchars($aluno->nome); ?></p>
            <p><strong>Nascimento:</strong> <?php echo htmlspecialchars($aluno->nascimento); ?></p>
            <p><strong>Curso:</strong> <?php echo htmlspecialchars($aluno->curso); ?></p>
            <p><strong>Matrícula:</strong> <?php echo htmlspecialchars($aluno->matricula); ?></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>