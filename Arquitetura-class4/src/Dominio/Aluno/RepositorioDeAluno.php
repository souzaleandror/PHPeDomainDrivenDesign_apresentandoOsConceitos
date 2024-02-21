<?php

namespace Alura\Arquitetura\Dominio\Aluno;

Interface RepositorioDeAluno
{

    public function adicionar(Aluno $aluno): void;
    public function buscarPorCpf(string $cpf): Aluno;
    public function editarPorCpf(Aluno $aluno): bool;
    public function buscarTodos(Aluno $aluno): array;

    public function removerAluno(Aluno $aluno): bool;
}