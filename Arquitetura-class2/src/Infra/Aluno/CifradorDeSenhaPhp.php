<?php

namespace Alura\Arquitetura\Infra\Aluno;

class CifradorDeSenhaPhp implements \Alura\Arquitetura\Dominio\Aluno\CifradorDeSenha
{

    public function cifrar(string $senha): string
    {
        return password_hash($senha, PASSWORD_ARGON2ID);
    }

    public function verificar(string $senhaEmTexto, string $senhaCifrado): bool
    {
        return password_hash($senhaEmTexto) === $senhaCifrado;
    }
}