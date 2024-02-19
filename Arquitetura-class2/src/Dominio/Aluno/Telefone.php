<?php

namespace Alura\Arquitetura\Dominio\Aluno;

class Telefone
{
    private string $ddd;
    private string $numero;

    /**
     * @param string $ddd
     * @param string $numero
     */
    public function __construct(string $ddd, string $numero)
    {
        $this->ddd = $ddd;
        $this->numero = $numero;
    }

    private function setDdd(string $ddd): void
    {
        $opcoes = [
            'options' => [
                'regexp' => '/\d{2}/'
            ]
        ];

        if(filter_var($ddd, FILTER_VALIDATE_REGEXP, $opcoes) === false) {
            throw new \InvalidArgumentException('DDD no formato invalido');
        }

        $this->ddd = $ddd;
    }

    private function setNumero(string $numero): void
    {
        $opcoes = [
            'options' => [
                'regexp' => '/\d{7}/'
            ]
        ];

        if(filter_var($numero, FILTER_VALIDATE_REGEXP, $opcoes) === false) {
            throw new \InvalidArgumentException('Numero no formato invalido');
        }
        $this->numero = $numero;

    }

    public function __toString(): string
    {
        return "({$this->ddd}) {$this->numero}";
    }

    public function ddd(): string
    {
        return $this->ddd;
    }

    public function telefone(): string
    {
        return $this->telefone();
    }

}