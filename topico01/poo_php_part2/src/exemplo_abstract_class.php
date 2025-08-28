<?php 

echo "<pre>";

use Gvg\Dbe2\classes\Atleta;
use Gvg\Dbe2\classes\Medico;
use Gvg\Dbe2\classes\Abstracts\Pessoa as PessoaAbstrata;
use Gvg\Dbe2\classes\Pessoa;
use Gvg\Dbe2\classes\logs\Relatorio;

$atl1 = new Atleta("Luizito",36,1.8,80);
$med1 = new Medico("Pualo Paixão",122343,"Fisioterapeuta");


echo "\nAtleta ".(($atl1 instanceof PessoaAbstrata)?"eh":"não eh")." PessoaAbstrata";
echo "\nMédico ".(($med1 instanceof Pessoa)?"eh":"não eh")."  Pessoa";

$relatorio = new Relatorio;

$relatorio->add($atl1);//Relatório recebe qualquer objeto de uma classe filha de PessoaAbstrata
$relatorio->add($med1);

$relatorio->imprime();

