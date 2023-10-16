<?php

require_once('Auxiliar/factoria.php');
require_once('Auxiliar/conexion.php');

class controllerPersona{

    public static function partidaFinalizada(){
        $partidaFinalizada=conexion::consultarPartidaFinalizada();

        if ($partidaFinalizada[0]) {
            
        }
    }
}