<?php
    $p = pi();
    $raio = $_GET['raio'];
    $formula = $p * ($raio * $raio);
    echo $formula;
?>