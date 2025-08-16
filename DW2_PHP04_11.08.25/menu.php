<?php
$paginaAtual = basename($_SERVER['SCRIPT_NAME']);
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Cadastro Alunos</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link <?php echo ($paginaAtual == 'formulario.php') ? 'active' : ''; ?>" href="formulario.php">Cadastrar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo ($paginaAtual == 'mostra.php') ? 'active' : ''; ?>" href="mostra.php">Mostrar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo ($paginaAtual == 'mostra_idade.php') ? 'active' : ''; ?>" href="mostra_idade.php">Idade</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="sair.php">Sair</a>
        </li>
      </ul>
    </div>
  </div>
</nav>