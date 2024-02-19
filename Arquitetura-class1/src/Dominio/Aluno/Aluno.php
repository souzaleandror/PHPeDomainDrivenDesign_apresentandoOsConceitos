<?php

namespace Alura\Arquitetura\Dominio\Aluno;

use Alura\Arquitetura\Dominio\Cpf;
use Alura\Arquitetura\Dominio\Email;

class Aluno
{
    private Cpf $cpf;
    private string $nome;

    private Email $email;

    private array $telefones;

    /**
     * @param Cpf $cpf
     * @param string $nome
     * @param Email $email
     * @param Telefone $telefones
     */

    public static function comCpfNomeEEmail(string $cpf, string $nome, string $email) : self
    {
        return new Aluno(new Cpf($cpf), $nome, new Email($nome));
    }
    public function __construct(Cpf $cpf, string $nome, Email $email)
    {
        $this->cpf = $cpf;
        $this->nome = $nome;
        $this->email = $email;
    }


    public function adicionarTelefone(string $ddd, string $numero): self
    {
        $this->telefones[] = new Telefone($ddd, $numero);
        return $this;
    }

    public function cpf(): string
    {
        return $this->cpf;
    }

    public function nome(): string
    {
        return $this->nome;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function telefones(): array
    {
        return $this->telefones;
    }

}