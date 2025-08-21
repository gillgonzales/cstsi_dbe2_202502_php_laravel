<?php

class Pessoa
{
	// public $nome, $idade, $altura, $peso;
	protected $imc;

	function __construct(
		public string $nome,
		public int $idade,
		protected float $peso = 0,
		protected float $altura = 0,
	) {
		// $this->nome = $nome;
		// $this->idade = $idade;
		// $this->altura = $altura;
		// $this->peso = $peso;
	}

	function __destruct()
	{
		echo "\n$this->nome foi destruido!";
	}

	function calcImc()
	{
		if (
			!is_numeric($this->altura)
			&& !is_numeric($this->peso)
			|| $this->altura <= 0
			|| $this->peso <= 0
		) {
			echo "\nIMC $this->nome: Erro, informe peso e altura corretamente.\n";
            return;//encerrou o metodo!!
        }

        $this->imc = $this->peso / $this->altura ** 2;
		echo "\nO IMC do $this->nome é: " . number_format($this->imc, 2) . "\n";
	}
}

class Funcionario extends Pessoa
{
	protected $salario;

	function __construct($nome, $idade, $altura, $peso, $salario = 0)
	{
		//super
		parent::__construct($nome, $idade, $peso, $altura);
		$this->salario = $salario;
	}

	function verSalario()
	{
		echo "\nSalario: " . $this->salario . "\n";
	}
}

class Professor extends Funcionario
{
	public $area;

	function __construct(
		$nome,
		$idade,
		$altura = null,
		$peso = null,
		$salario = 0
	) {
		parent::__construct($nome, $idade, $altura, $peso, $salario, $area='geral');
        $this->area = $area;
        $this->salario = $salario;
    }

	public function areaAtuacao()
	{
		echo "\nAtua na área: " . $this->area;
	}

	public function verImc(){
		   echo "\n O imc do Professor $this->nome é:".number_format($this->imc, 2);
	}
}

$pessoaUm = new Pessoa("Joao", 35);
$pessoaDois = new Funcionario("Lucia", 60, 1.55, 89, 3000);


$pessoaUm->calcImc();
$pessoaDois->calcImc();

$pessoaTres = new Professor('Gill', 35, 1.55, 89, 5000);
$pessoaTres->calcImc(); //Pessoa
$pessoaTres->verSalario(); //Funcionario
$pessoaTres->areaAtuacao(); //Professor
$pessoaTres->verImc(); //Professor



echo "\n====================VARDUMP DOS OBJETOS=============\n";
var_dump($pessoaUm, $pessoaDois, $pessoaTres);
