<?php

namespace Alura\Arquitetura\Dominio\Aluno;

use Alura\Arquitetura\Dominio\Cpf;
use Alura\Arquitetura\Dominio\Evento;
use Alura\Arquitetura\Dominio\PublicadorDeEvento;

class AlunoMatriculado implements Evento
{

    private \DateTimeImmutable $momento;
    private Cpf $cpfAluno;
    private PublicadorDeEvento $publicador;

    public function __construct(Cpf $cpf)
    {
        $this->momento = new \DateTimeImmutable();
        $this->cpfAluno;
    }

    public function cpfAluno(): Cpf
    {
        return $this->cpfAluno;
    }

    public function momento(): \DateTimeImmutable
    {
        return $this->momento;
    }
}