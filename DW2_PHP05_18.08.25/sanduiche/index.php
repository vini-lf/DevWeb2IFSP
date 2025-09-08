<?php
session_start();

if (isset($_GET['limpar'])) {
    session_destroy();
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Peça seu Sanduíche</title>
</head>
<body>

    <main class="container mt-4 mb-5">
        <div class="col-lg-8 mx-auto">
            <h1>Monte seu Sanduíche</h1>
            <p class="lead">Escolha suas opções abaixo.</p>
            <hr>

            <form action="resumo.php" method="POST">
                
                <div class="card mb-3">
                    <div class="card-header"><h5>Onde vai comer?</h5></div>
                    <div class="card-body">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="local" id="local1" value="Comer no Local" required>
                            <label class="form-check-label" for="local1">Comer no Local</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="local" id="local2" value="Para Viagem">
                            <label class="form-check-label" for="local2">Para Viagem</label>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header"><h5>Ingredientes Principais</h5></div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label"><strong>Pão</strong></label>
                            <select name="pao" class="form-select" required>
                                <option value="" disabled selected>Selecione um pão</option>
                                <option value="Italiano Branco">Italiano Branco</option>
                                <option value="Integral">Integral</option>
                                <option value="Parmesão e Orégano">Parmesão e Orégano</option>
                            </select>
                        </div>
                        <div class="mb-3">
                             <label class="form-label"><strong>Recheio</strong></label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="recheio" id="recheio1" value="Carne" required>
                                <label class="form-check-label" for="recheio1">Carne</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="recheio" id="recheio2" value="Frango">
                                <label class="form-check-label" for="recheio2">Frango</label>
                            </div>
                        </div>
                         <div>
                             <label class="form-label"><strong>Queijo</strong></label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="queijo" id="queijo1" value="Prato" required>
                                <label class="form-check-label" for="queijo1">Prato</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="queijo" id="queijo2" value="Cheddar">
                                <label class="form-check-label" for="queijo2">Cheddar</label>
                            </div>
                             <div class="form-check">
                                <input class="form-check-input" type="radio" name="queijo" id="queijo3" value="Suíço">
                                <label class="form-check-label" for="queijo3">Suíço</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                     <div class="card-header"><h5>Adicionais</h5></div>
                     <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label"><strong>Vegetais</strong></label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="vegetais[]" value="Alface" id="veg1">
                                <label class="form-check-label" for="veg1">Alface</label>
                            </div>
                             <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="vegetais[]" value="Tomate" id="veg2">
                                <label class="form-check-label" for="veg2">Tomate</label>
                            </div>
                             <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="vegetais[]" value="Cebola Roxa" id="veg3">
                                <label class="form-check-label" for="veg3">Cebola Roxa</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="vegetais[]" value="Picles" id="veg4">
                                <label class="form-check-label" for="veg4">Picles</label>
                            </div>
                        </div>
                        <div>
                            <label class="form-label"><strong>Molhos</strong></label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="molhos[]" value="Maionese Temperada" id="molho1">
                                <label class="form-check-label" for="molho1">Maionese Temperada</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="molhos[]" value="Mostarda e Mel" id="molho2">
                                <label class="form-check-label" for="molho2">Mostarda e Mel</label>
                            </div>
                             <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="molhos[]" value="Chipotle" id="molho3">
                                <label class="form-check-label" for="molho3">Chipotle</label>
                            </div>
                        </div>
                     </div>
                </div>
                
                 <div class="card mb-4">
                    <div class="card-header"><h5>Pagamento</h5></div>
                    <div class="card-body">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="pagamento" id="pag1" value="Pix" required>
                            <label class="form-check-label" for="pag1">Pix</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="pagamento" id="pag2" value="Cartão">
                            <label class="form-check-label" for="pag2">Cartão</label>
                        </div>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">Finalizar Pedido</button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>