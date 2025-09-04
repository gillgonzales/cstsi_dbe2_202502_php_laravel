<?php 

echo "<pre>";

use Gvg\Dbe2\classes\Abstracts\Pessoa;
use Gvg\Dbe2\classes\Arbitro;
use Gvg\Dbe2\classes\Atleta;
use Gvg\Dbe2\classes\Esportista;
use Gvg\Dbe2\classes\Jogador;
use Gvg\Dbe2\classes\JogadorAtacante;
use Gvg\Dbe2\classes\JogadorDefesa;
use Gvg\Dbe2\classes\Medico;
use Gvg\Dbe2\classes\Torcedor;
use Gvg\Dbe2\interfaces\IMC;

function esperaObjetoQueImplementaIMC(IMC $pessoaComIMC){
    $pessoaComIMC->showImc();
};

function esperaObjetoQueMostraIMC(Jogador $pessoaUsaIMC){
    $pessoaUsaIMC->showImc();
};

$atl1 = new Atleta("Walter Kannemann",33,1.84,83);
$med1 = new Medico("Pualo Paixão",122343,"Fisioterapeuta",60,1.8,90);
$arbi = new Arbitro("Anderson Daronco",43,'Juiz',1.88,90);

$torc =  new Torcedor("Gill", 30, 75,1.9, "Tricolor" );
$sport = new Esportista("Fulano",24,1.75,80);

$atl2 = new JogadorDefesa("Pedro Geromel",36, 1.83,75);
$atl3 = new JogadorAtacante("Luiz Soarez",36,1.8,80);


esperaObjetoQueImplementaIMC($torc);

esperaObjetoQueImplementaIMC($med1);

esperaObjetoQueImplementaIMC($atl1);

esperaObjetoQueImplementaIMC($arbi);

// esperaObjetoQueImplementaIMC($sport);


esperaObjetoQueMostraIMC($atl2);

esperaObjetoQueMostraIMC($atl3);



// $class = Jogador::class;
// $class = Pessoa::class;
$class = IMC::class;

if($atl1 instanceof $class)
    echo "\n\n\t $atl1->nome é um instância de $class";

echo "\n";