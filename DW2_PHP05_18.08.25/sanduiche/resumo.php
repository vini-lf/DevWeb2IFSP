<?php
session_start();

if (isset($_POST['local'])) {
    $_SESSION['local'] = $_POST['local'];
    $_SESSION['pao'] = $_POST['pao'];
    $_SESSION['recheio'] = $_POST['recheio'];
    $_SESSION['queijo'] = $_POST['queijo'];
    $_SESSION['pagamento'] = $_POST['pagamento'];

    if (isset($_POST['vegetais'])) {
        $_SESSION['vegetais'] = $_POST['vegetais'];
    } else {
        $_SESSION['vegetais'] = [];
    }

    if (isset($_POST['molhos'])) {
        $_SESSION['molhos'] = $_POST['molhos'];
    } else {
        $_SESSION['molhos'] = [];
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Resumo do Pedido</title>
</head>
<body>
    
    <main class="container mt-4">
        <div class="col-lg-8 mx-auto">
            <div class="alert alert-success">
                <h3>Pedido Confirmado!</h3>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>Resumo do seu Pedido</h4>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Local:</strong> <?php echo $_SESSION['local']; ?></li>
                    <li class="list-group-item"><strong>Pão:</strong> <?php echo $_SESSION['pao']; ?></li>
                    <li class="list-group-item"><strong>Recheio:</strong> <?php echo $_SESSION['recheio']; ?></li>
                    <li class="list-group-item"><strong>Queijo:</strong> <?php echo $_SESSION['queijo']; ?></li>
                    <li class="list-group-item">
                        <strong>Vegetais:</strong>
                        <?php
                        if (!empty($_SESSION['vegetais'])) {
                            echo implode(', ', $_SESSION['vegetais']);
                        } else {
                            echo "Nenhum";
                        }
                        ?>
                    </li>
                    <li class="list-group-item">
                        <strong>Molhos:</strong>
                        <?php
                        if (!empty($_SESSION['molhos'])) {
                            echo implode(', ', $_SESSION['molhos']);
                        } else {
                            echo "Nenhum";
                        }
                        ?>
                    </li>
                    <li class="list-group-item"><strong>Pagamento:</strong> <?php echo $_SESSION['pagamento']; ?></li>
                </ul>
            </div>

            <div class="mt-4">
                <a href="index.php?limpar=1" class="btn btn-secondary">Fazer Novo Pedido</a>
            </div>
        </div>
    </main>

</body>
</html>