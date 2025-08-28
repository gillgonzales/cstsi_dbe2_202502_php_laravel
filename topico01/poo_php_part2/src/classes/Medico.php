<?php
namespace Gvg\Dbe2\classes;

use Exception;
use Gvg\Dbe2\interfaces\IMC;

class Medico extends Pessoa implements IMC{

	private $CRM, $especialidade, $imc;

	public function __construct($nome, $crm,$especialidade,$idade=null,$altura=1, $peso=1)
	{
		$this->nome = $nome;
		$this->CRM = $crm;
		$this->especialidade = $especialidade;
		$this->idade = $idade;
		$this->peso = $peso;
		$this->altura = $altura;
		$this->calcImc();
	}

	public function getCRM(){
		return $this->CRM;
	}

	public function calcImc():void 
	{
		try {
			if(isset($this->peso)&&isset($this->altura)) {
				$this->imc = $this->peso/$this->altura**2;		
			} else{
				throw new Exception("Erro, defina peso e altura primeiro!");
			}
		} catch (Exception $error) {
			echo $error->getMessage();
			foreach($error->getTrace() as $trace)
				 print_r($trace);
			throw $error;
		}
	}

	public function showImc():void
	{
		if(is_numeric($this->imc))
			echo "\nO IMC do Médico $this->nome é: " . number_format($this->imc, 2) . "\n";
	}

	public function __toString()
	{
		$className = self::class;
		return 	"\n=== Dados de $className ==="
			. "\nHerança: ".parent::class
			. "\nAtributos:"
			. "\nIMC: ".$this->imc
			. "\n\tNome: $this->nome"
			. ($this->idade ? "\n\tIdade: $this->idade" : "")
			. "\n\tEspecialidade: $this->especialidade"
			. "\n\tCRM: $this->CRM\n";
	}
}