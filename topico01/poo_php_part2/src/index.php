<?php

require "../vendor/autoload.php";

use Gvg\Dbe2\classes\Atleta;


$atl1 = new Atleta("Luizito Soares",36,1.8,80);

echo "<hr>";//---
echo "<pre>";
$atl1->showImc();

var_dump($atl1);

require "slugfy.php";