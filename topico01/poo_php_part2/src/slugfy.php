<?php

echo "<pre>";

use Gvg\Dbe2\classes\Atleta;
use Gvg\Dbe2\classes\Medico;
use Illuminate\Support\Str;

$atl2 = new Atleta("Pedro Geromel",36,1.83,75);
$med1 = new Medico("Pualo Paixão",122343,"Fisioterapeuta");

$list = [$atl1,$atl2,$med1];

var_dump($list);

print_r(
    array_map(
        fn($p)=>Str::slug($p->nome),
        $list
    )
);

