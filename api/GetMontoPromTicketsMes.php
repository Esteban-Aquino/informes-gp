<?php

/**
 * Obtiene todas las listas de la base de datos
 */

require_once '../config/operacionesDB.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    ini_set('max_execution_time', 480);

    // Manejar petición GET
    $result= operacionesDB::getMontoPromedioTicketsMes();
    
    if ($result) {

        /*$datos["estado"] = 1;*/
         $datos["datos"] = $result;
         print json_encode($datos);
            //echo json_last_error();
    } else {
        print json_encode(array("estado" => "Error",
                                "mensaje" => "Ha ocurrido un error"));
    }
}

?>
