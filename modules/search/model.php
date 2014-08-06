<?php

class modelBuscador {
    
    public static function busquedaPorPalabra(){
        $db = new database();
        $sql = "SELECT si.*, i.ruta
                FROM sitios_interes si, imagenes i 
                WHERE si.imagen_portada = i.id 
                AND si.titulo LIKE '%".$_POST['buscador']."%'";
        $db->query($sql);
        return $db->cargaMatriz();
    }
    
    public static function busquedaPorFiltro(){
        $db = new database();
        $sql = "SELECT si.*, i.ruta
                FROM sitios_interes si, imagenes i 
                WHERE si.imagen_portada = i.id 
                AND si.titulo LIKE '%".$_POST['buscador']."%'
                AND si.autonomias_id = ".$_POST['autonomias'];
        $db->query($sql);
        return $db->cargaMatriz();
    }
}

?>

