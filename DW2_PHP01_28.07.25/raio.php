<?php
    $p = pi();
    $raio = $_POST['raio'];
    $formula = $p * ($raio * $raio);
    echo $formula;
?>