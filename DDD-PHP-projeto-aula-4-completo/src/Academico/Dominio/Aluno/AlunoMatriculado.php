<?php

namespace Alura\Arquitetura\Academico\Dominio\Aluno;

use Alura\Arquitetura\Academico\Dominio\Cpf;
use Alura\Arquitetura\Academico\Dominio\Evento;

class AlunoMatriculado implements Evento
{
    private \DateTimeImmutable $momento;
    private Cpf $cpfAluno;

    public function __construct(Cpf $cpfAluno)
    {
        $this->momento = new \DateTimeImmutable();
        $this->cpfAluno = $cpfAluno;
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
