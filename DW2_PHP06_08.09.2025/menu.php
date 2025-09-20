<?php
session_start();
if (!isset($_SESSION['tarefas'])) {
    $_SESSION['tarefas'] = array();
}
$total = count($_SESSION['tarefas']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Tarefas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="menu.php">Tarefas</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="lista.php?filtro=hoje">Hoje</a></li>
        <li class="nav-item"><a class="nav-link" href="nova.php">Nova</a></li>
        <li class="nav-item"><a class="nav-link" href="lista.php?filtro=todas">Todas</a></li>
      </ul>
      <span class="navbar-text text-white">
        Total: <?php echo $total; ?>
      </span>
    </div>
  </div>
</nav>

<div class="container mt-4">
  <h2>Bem-vindo ao Gerenciador de Tarefas</h2>
  <p>Use o menu para navegar.</p>
</div>
</body>
</html>
