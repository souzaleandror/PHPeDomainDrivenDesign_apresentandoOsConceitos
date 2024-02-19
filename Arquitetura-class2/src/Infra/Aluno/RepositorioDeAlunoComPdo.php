<?php

namespace Alura\Arquitetura\Infra\Aluno;

use Alura\Arquitetura\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Dominio\Aluno\RepositorioDeAluno;

class RepositorioDeAlunoComPdo implements RepositorioDeAluno
{
    private \PDO $conexao;

    public function __construct(\PDO $conexao)
    {
        $this->conexao = $conexao;
    }

    public function adicionar(Aluno $aluno): void
    {
        $sql = 'INSERT INTO alunos VALUES (:cpf, :nome, :email);';
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue('cpf', $aluno->cpf());
        $stmt->bindValue('nome', $aluno->nome());
        $stmt->bindValue('email', $aluno->email());
        $stmt->execute();

        $sql = 'INSERT INTO telefones VALUES (:ddd, :numero, :cpf_aluno);';
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue('cpf_aluno', $aluno->cpf());

        foreach ($aluno->telefones() as $telefone ) {
            $stmt->bindValue('ddd', $telefone->ddd());
            $stmt->bindValue('telefone', $telefone->telefone());
            $stmt->execute();
        }
    }

    public function buscarPorCpf(string $cpf): Aluno
    {
        $sql = 'SELECT cpf, nome, email, ddd, numero as numero_telefone FROM alunos
        LEFT JOIN telefones ON telefones.cpf_aluno = aluno.cpf WHERE alunos.cpf = ?;';

        $smt = $this->conexao->query($sql);
        $smt->bindValue(1, (string) $cpf);
        $smt->execute();
    }

    public function editarPorCpf(Aluno $aluno): bool
    {
        // TODO: Implement editarPorCpf() method.
    }

    public function buscarTodos(Aluno $aluno): array
    {
        $sql = 'SELECT cpf, nome, email, ddd, numero as numero_telefone FROM alunos
        LEFT JOIN telefones ON telefones.cpf_aluno = aluno.cpf WHERE alunos.cpf = ?;';

        $smt = $this->conexao->query($sql);
        $smt->execute();
    }

    public function removerAluno(Aluno $aluno): bool
    {
        // TODO: Implement removerAluno() method.
    }
}