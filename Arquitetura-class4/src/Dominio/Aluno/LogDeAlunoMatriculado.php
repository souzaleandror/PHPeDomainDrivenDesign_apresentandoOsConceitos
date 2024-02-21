<?php

namespace Alura\Arquitetura\Dominio\Aluno;

use Alura\Arquitetura\Dominio\Evento;
use Alura\Arquitetura\Dominio\OuvinteDeEvento;

class LogDeAlunoMatriculado extends OuvinteDeEvento
{
    /**
     * @param AlunoMatriculado $alunoMatriculado
     * @return void
     */
    public function reageAo(Evento $alunoMatriculado): void
    {
        fprintf(
            STDERR,
            'Aluno com CPF %s foi matriculado da data %s',
            (string) $alunoMatriculado->cpfAluno(),
            $alunoMatriculado->momento()->format('d/m/Y'),
        );
    }

    public function sabeProcessar(Evento $evento): bool
    {
        return $evento instanceof AlunoMatriculado;
    }
}