<?php 

echo "<pre>";

use Gvg\Dbe2\classes\Atleta;
use Gvg\Dbe2\classes\JogadorAtacante;
use Gvg\Dbe2\classes\JogadorDefesa;
use Gvg\Dbe2\classes\Medico;
use Gvg\Dbe2\classes\logs\Relatorio;

// $atl1 = new Jogador("Pedro Geromel",36,1.83,75);
$atl1 = new Atleta("Luizito",36,1.8,80);
$med1 = new Medico("Pualo Paixão",122343,"Fisioterapeuta",80,1.8,90);
$atl2 = new JogadorDefesa("Pedro Geromel",36, 1.83,75);
$atl3 = new JogadorAtacante("Luiz Soarez",36,1.8,80);

$atl2->estaComBola = true;
$atl3->estaComBola = true;

$relatorio = new Relatorio;
$relatorio->add($med1);
$relatorio->add($atl1);
$relatorio->add($atl2);
$relatorio->add($atl3);
$relatorio->imprime();