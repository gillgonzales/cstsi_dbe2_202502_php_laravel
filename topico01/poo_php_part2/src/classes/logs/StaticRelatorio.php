<?php 
namespace Gvg\Dbe2\classes\logs;

use Gvg\Dbe2\classes\Atleta as AtletaData;

class StaticRelatorio {
	public static function log(AtletaData $atleta){
		echo "\nLog:\n".$atleta;
	}
}