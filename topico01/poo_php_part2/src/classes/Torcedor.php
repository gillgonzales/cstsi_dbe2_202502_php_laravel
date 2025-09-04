<?php

namespace Gvg\Dbe2\classes;

use Gvg\Dbe2\interfaces\IMC;

class Torcedor extends Pessoa implements IMC
{

    private float $imc;

    public function __construct(
        public string $nome,
        public int | null $idade,
        public float | null $peso,
        public float | null $altura,
        public string $time,
    ) {
        echo "\nTorcedor do $this->time!!!";
        $this->calcIMC();
    }

    public function calcIMC(): void
    {
        if(isset($this->peso)&&isset($this->altura)) {
            $this->imc = $this->peso/$this->altura**2;
        } else {
            echo "Erro, defina peso e altura primeiro!";
        }
    }

    public function showIMC(): void
    {
        $msg = "\nIMC $this->nome: ";
        if(isset($this->imc)) {
            $msg.= number_format($this->imc, 2);
        } else {
            $msg .= " Erro, calcule o imc primeiro";
        }
        echo $msg;
    }

}
