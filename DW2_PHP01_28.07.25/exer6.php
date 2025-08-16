<?php
    $cpital = $_GET['C'];
    $taxa = $_GET['T'];
    $tempo = $_GET['TE'];
    $juros = $cpital * $taxa * $tempo;
    echo $juros;
?>