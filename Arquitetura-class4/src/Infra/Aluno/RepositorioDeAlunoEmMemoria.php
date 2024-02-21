<?php

namespace Alura\Arquitetura\Infra\Aluno;

use Alura\Arquitetura\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Dominio\Aluno\RepositorioDeAluno;

class RepositorioDeAlunoEmMemoria implements RepositorioDeAluno
{

    public function adicionar(Aluno $aluno): void
    {
        // TODO: Implement adicionar() method.
    }

    public function buscarPorCpf(string $cpf): Aluno
    {
        // TODO: Implement buscarPorCpf() method.
    }

    public function editarPorCpf(Aluno $aluno): bool
    {
        // TODO: Implement editarPorCpf() method.
    }

    public function buscarTodos(Aluno $aluno): array
    {
        // TODO: Implement buscarTodos() method.
    }

    public function removerAluno(Aluno $aluno): bool
    {
        // TODO: Implement removerAluno() method.
    }
}