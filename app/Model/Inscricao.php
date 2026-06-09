<?php

namespace App\Model;

class Inscricao {
    private ?int $id = null;
    private string $nome;
    private string $email;
    private string $curso;

    public function __construct(string $nome = '', string $email = '', string $curso = '', ?int $id = null) {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->curso = $curso;
    }

    // Métodos mágicos para ler propriedades de forma enxuta
    public function __get($propriedade) {
        if (property_exists($this, $propriedade)) {
            return $this->$propriedade;
        }
        return null;
    }

    public function __set($propriedade, $valor) {
        if (property_exists($this, $propriedade)) {
            $this->$propriedade = $valor;
        }
    }
}