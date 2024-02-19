<?php

namespace Alura\Arquitetura\Infra\Aluno;

class CifradorDeSenha implements \Alura\Arquitetura\Dominio\Aluno\CifradorDeSenha
{

    public function cifrar(string $senha): string
    {
        return md5($senha);
    }

    public function verificar(string $senhaEmTexto, string $senhaCifrado): bool
    {
        return md5($senhaEmTexto) === $senhaCifrado;
    }
}