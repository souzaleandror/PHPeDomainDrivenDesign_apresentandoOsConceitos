<?php

namespace Alura\Arquitetura\Dominio\Aluno;

interface CifradorDeSenha
{
    public function cifrar(string $senha): string;

    public function verificar(string $senhaEmTexto, string $senhaCifrado): bool;
}