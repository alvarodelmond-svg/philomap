<?php

namespace App\Models;

class Favorito {
    public ?int $id;
    public int $usuario_id;
    public string $conteudo_id;
    public string $titulo_conteudo;
    public ?string $data_favorito;

    public function __construct(int $usuario_id, string $conteudo_id, string $titulo_conteudo, ?int $id = null, ?string $data_favorito = null) {
        $this->id = $id;
        $this->usuario_id = $usuario_id;
        $this->conteudo_id = $conteudo_id;
        $this->titulo_conteudo = $titulo_conteudo;
        $this->data_favorito = $data_favorito;
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'usuario_id' => $this->usuario_id,
            'conteudo_id' => $this->conteudo_id,
            'titulo_conteudo' => $this->titulo_conteudo,
            'data_favorito' => $this->data_favorito
        ];
    }
}
