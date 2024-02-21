<?php

namespace Alura\Arquitetura\Dominio;

Interface Evento
{
    public function momento(): \DateTimeImmutable;

}