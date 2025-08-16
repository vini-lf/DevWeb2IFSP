<?php

class Aluno {
    public $nome;
    public $nascimento;
    public $curso;
    public $matricula;

    public function __construct($nome, $nascimento, $curso, $matricula) {
        $this->nome = $nome;
        $this->nascimento = $nascimento;
        $this->curso = $curso;
        $this->matricula = $matricula;
    }

    public function idade() {
        $dataNascimento = new DateTime($this->nascimento);
        $hoje = new DateTime();
        $diferenca = $hoje->diff($dataNascimento);
        return $diferenca->y;
    }
}
?>