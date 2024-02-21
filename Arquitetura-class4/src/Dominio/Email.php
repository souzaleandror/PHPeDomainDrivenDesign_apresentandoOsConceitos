<?php

namespace Alura\Arquitetura\Dominio;

class Email implements  \Stringable
{

    private string $endereco;

    public function __contruct(string $endereco) {
        if(filter_var($endereco, FILTER_VALIDATE_EMAIL) === false) {
            throw new \InvalidArgumentException('Endereco de email invalido');
        }
        $this->endereco = $endereco;
    }


    public function __toString(): string
    {
        return $this->endereco;
    }
}