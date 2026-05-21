<?php

namespace App\Models;

class Inscricao {
    public ?int $id;
    public string $nome;
    public int $idade;
    public string $estudo;
    public ?string $data_inscricao;

    public function __construct(string $nome, int $idade, string $estudo, ?int $id = null, ?string $data_inscricao = null) {
        $this->id = $id;
        $this->nome = $nome;
        $this->idade = $idade;
        $this->estudo = $estudo;
        $this->data_inscricao = $data_inscricao;
    }
}
