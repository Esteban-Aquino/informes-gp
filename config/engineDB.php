<?php

/**
 * Iteracciones del motor con la bd
 * Esteban Aquino 06/05/2020
 */
require 'oraconnect.php';
require '../util.php';

class engineDB {

    function __construct() {
        
    }
    
    public static function getTipoDato($tabla, $columna) {
        $autorizado = false;
        try {
            $conn = null;
            $consulta = "SELECT C.DATA_TYPE
                         FROM USER_TAB_COLUMNS C
                         WHERE C.TABLE_NAME = :TABLA
                         AND C.COLUMN_NAME = :COLUMNA";
            // Preparar sentencia
            $comando = oraconnect::getInstance()->getDb()->prepare($consulta);

            // Ejecutar sentencia preparada
            $comando->execute([':TABLA' => $tabla,
                               ':COLUMNA' => $columna]);

            $result = $comando->fetchAll(PDO::FETCH_ASSOC)[0]['DATA_TYPE'];
            //print count($result);
            IF (count($result) == 0) {
                return 'NN';
            } ELSE {
                return $result;
            }
        } catch (PDOException $e) {
            print (utf8_converter($e->getMessage()));
            return $e->getMessage();
        }
    }

     public static function GetListaAgg($consulta, $pivot) {
        $autorizado = false;
        try {
            $conn = null;
            $consulta = "SELECT C.DATA_TYPE
                         FROM USER_TAB_COLUMNS C
                         WHERE C.TABLE_NAME = :TABLA
                         AND C.COLUMN_NAME = :COLUMNA";
            // Preparar sentencia
            $comando = oraconnect::getInstance()->getDb()->prepare($consulta);

            // Ejecutar sentencia preparada
            $comando->execute([':TABLA' => $tabla,
                               ':COLUMNA' => $columna]);

            $result = $comando->fetchAll(PDO::FETCH_ASSOC)[0]['DATA_TYPE'];
            //print count($result);
            IF (count($result) == 0) {
                return 'NN';
            } ELSE {
                return $result;
            }
        } catch (PDOException $e) {
            print (utf8_converter($e->getMessage()));
            return $e->getMessage();
        }
    }

    
}