<?php

require "../vendor/autoload.php";

use Gvg\Dbe2\classes\Atleta;


$atl1 = new Atleta("Luizito",36,1.8,80);

echo "O IMC do $atl1->nome".$atl1->showImc();

echo "<hr>";
echo "<pre>";
$atl1->imc = [1.8,110];

var_dump($atl1);

echo "O Novo IMC do $atl1->nome".$atl1->showImc();