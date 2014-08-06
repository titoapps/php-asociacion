<?php

class cargador {

    public static function contenido($componente){
        ob_start();
        include 'modules/'.$componente.'/controller.php';
        $buffer = ob_get_clean();
        return $buffer;
    }

}
