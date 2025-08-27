<?php
namespace Gvg\Dbe2\classes;

use Exception;

class Atleta extends Pessoa{

	// public $altura, $peso;
	private $imc;
	
	public function __construct($nome, $idade, $altura, $peso)
	{
		$this->nome = $nome;
		$this->idade = $idade;
		$this->altura = $altura;
		$this->peso = $peso;
		// parent::__construct($nome, $idade, $peso, $altura);
		$this->calcImc();
	}

	public function setAltura(float $altura){
		$this->altura = $altura;
		$this->calcImc();
	}

	public function setPeso(float $peso){
		$this->peso = $peso;
		$this->calcImc();
	}

	public function __set($name, $value){
		
		if($name=='imc'){
		var_dump($name,$value);
			if(is_array($value)){
				if($value[0] > $value[1])
					$this->imc = $value[0]/$value[1]**2;
				else throw new Exception("Erro, o primeiro valor deve ser o peso.");
			}else{
				echo "Erro ao atualizar imc, esperado um array [peso, altura]";
			}
		}else{
			$this->$name = $value;
		} 
	}


	public function __toString():string {
               $saida = "\n===Dados do ".self::class 
			   ."==="
               ."\nNome: $this->nome"
               .($this->idade ? "\nIdade: $this->idade" : "")
               ."\nPessoa: $this->peso"
               ."\nAltura: $this->altura";

		$saida .= (isset($this->imc))
				?"\nIMC: ".number_format($this->imc, 3)
				:"";
		return $saida;
	}
}