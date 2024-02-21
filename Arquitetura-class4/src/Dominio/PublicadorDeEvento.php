<?php

namespace Alura\Arquitetura\Dominio;

class PublicadorDeEvento
{

    private array $ouvintes = [];

    public function adicionarOuvinte(OuvinteDeEvento $ouvinte): void
    {
        $this->ouvintes[] = $ouvinte;
    }

    public function publicar(Evento $evento)
    {
        foreach ($this->ouvintes as $ouvinte) {
            $ouvinte->processa($evento);
        }
    }

}