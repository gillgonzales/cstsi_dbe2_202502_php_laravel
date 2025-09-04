<?php

namespace Gvg\Dbe2\classes;

use Gvg\Dbe2\traits\jogadores\Zagueiro;

class JogadorDefesa extends Jogador
{

	use Zagueiro;

	public $altura, $peso;

	public function __construct($nome, $idade, $altura, $peso)
	{
		$this->nome = $nome;
		$this->idade = $idade;
		$this->altura = $altura;
		$this->peso = $peso;
		$this->calcImc();
	}

	public function __toString(): string
	{
		$saida = "\n===Dados do " . self::class
			. "==="
			. "\nNome: $this->nome"
			. ($this->idade ? "\nIdade: $this->idade" : "")
			. "\nPessoa: $this->peso"
			. "\nAltura: $this->altura";

		$saida .= (isset($this->imc))
			? "\nIMC: " . number_format($this->imc, 3)
			: "";

		if ($this->estaComBola) {
			$saida .= "\n\nPasses:";
			$saida .= "\n" . $this->umDoisCurto();
			$saida .= "\n" . $this->lancamento();
			$saida .= "\n" . $this->lancamentoLongo();
		}
		$this->estaComBola = false;
			$saida .= "\n\nZagueiro:";
			$saida .= "\n" . $this->carrinho();
			$saida .= "\n" . $this->cercaAdversario();
		return $saida;
	}
}
