<?php

/**
 * Todas las interacciones con la base de datos se coloca aqui
 * Esteban Aquino 30/09/2019
 */
require 'oraconnect.php';
require_once 'db.php';
require '../util.php';

class operacionesDB {

    function __construct() {
        
    }

    /**
     * Retorna usuario logueado
     *
     * @param Usuario, Clave
     * @return usuario logueado
     */
    public static function ValidarUsuario($usuario, $clave) {
        $autorizado = false;
        try {
            // $conn = new PDO('odbc:Driver={Microsoft ODBC for Oracle}; Server=' . DATABASE, $usuario, $clave);
            $conn = new PDO("oci:dbname=".TNS, $usuario, $clave);
            IF ($conn !== null) {
                $conn = null;
                $consulta = "SELECT INITCAP(P.NOMBRE) NOMBRE_USUARIO,U.COD_USUARIO, U.ESTADO
                            FROM USUARIOS U
                                 JOIN PERSONAS P
                                 ON U.COD_PERSONA = P.COD_PERSONA
                           WHERE U.COD_USUARIO = UPPER('" . $usuario . "')";
                //print $consulta;
                // Preparar sentencia
                $comando = oraconnect::getInstance()->getDb()->query($consulta);
                // Ejecutar sentencia preparada
                $comando->execute();
                $result = $comando->fetchAll(PDO::FETCH_ASSOC);
                IF ($result !== null) {
                    IF ($result[0]['ESTADO'] === 'A') {
                        $autorizado = true;
                    }
                }
            }
            if ($autorizado) {
                return utf8_converter($result);
            }
        } catch (PDOException $e) {
            return null;
        }
    }

    /**
     * Retorna datos de venta del dia ANTERIOR
     *
     * @param Nada
     * @return ventas del dia
     */
    public static function getVentasAyer() {
        $consulta = "SELECT * FROM V_INF_VENTAS_AYER";
        try {
            // Preparar sentencia
            $comando = oraconnect::getInstance()->getDb()->query($consulta);
            // Ejecutar sentencia preparada
            //$comando->execute(array($nombre));
            $comando->execute();
            $result = $comando->fetchAll(PDO::FETCH_ASSOC);
            //print_r($result);
            //print utf8_converter($result);
            return utf8_converter($result);
            
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Retorna datos de venta del dia
     *
     * @param Nada
     * @return ventas del dia
     */
    public static function getVentasDia() {
        $consulta = "SELECT *"
                . "FROM V_INF_VENTAS_DIA";
        try {
            // Preparar sentencia
            $comando = oraconnect::getInstance()->getDb()->query($consulta);
            // Ejecutar sentencia preparada
            //$comando->execute(array($nombre));
            $comando->execute();
            $result = $comando->fetchAll(PDO::FETCH_ASSOC);
          
          return utf8_converter($result);
        } catch (PDOException $e) {
            return false;
        }
    }
    
    /**
     * Retorna datos de venta del mes actual
     *
     * @param Nada
     * @return ventas del dia
     */
    public static function getVentasMes() {
        $consulta = "SELECT *"
                . "FROM V_INF_VENTAS_MES";
        try {
            // Preparar sentencia
            $comando = oraconnect::getInstance()->getDb()->query($consulta);
            // Ejecutar sentencia preparada
            //$comando->execute(array($nombre));
            $comando->execute();
            $result = $comando->fetchAll(PDO::FETCH_ASSOC);
          
          return utf8_converter($result);
        } catch (PDOException $e) {
            return false;
        }
    }
    
    /**
     * Retorna renta del año en compraraion al pasado
     *
     * @param Nada
     * @return renta año
     */
    public static function getRentaAnio() {
        $consulta = "SELECT *"
                . "FROM V_INF_RENTA_ANIO";
        try {
            // Preparar sentencia
            $comando = oraconnect::getInstance()->getDb()->query($consulta);
            // Ejecutar sentencia preparada
            //$comando->execute(array($nombre));
            $comando->execute();
            $result = $comando->fetchAll(PDO::FETCH_ASSOC);
          
          return utf8_converter($result);
        } catch (PDOException $e) {
            return false;
        }
    }
    
    /**
     * Retorna renta del año en compraraion al pasado
     *
     * @param Nada
     * @return renta año
     */
    public static function getUnidadesMes() {
        $consulta = "SELECT *"
                . "FROM V_INF_UNIDADES_MES";
        try {
            // Preparar sentencia
            $comando = oraconnect::getInstance()->getDb()->query($consulta);
            // Ejecutar sentencia preparada
            //$comando->execute(array($nombre));
            $comando->execute();
            $result = $comando->fetchAll(PDO::FETCH_ASSOC);
          
          return utf8_converter($result);
        } catch (PDOException $e) {
            return false;
        }
    }
    
    /**
     * Retorna renta del año en compraraion al pasado
     *
     * @param Nada
     * @return renta año
     */
    public static function getTicketsMes() {
        $consulta = "SELECT *"
                . "FROM V_INF_TICKETS_MES";
        try {
            // Preparar sentencia
            $comando = oraconnect::getInstance()->getDb()->query($consulta);
            // Ejecutar sentencia preparada
            //$comando->execute(array($nombre));
            $comando->execute();
            $result = $comando->fetchAll(PDO::FETCH_ASSOC);
          
          return utf8_converter($result);
        } catch (PDOException $e) {
            return false;
        }
    }
    
    /**
     * Retorna renta del año en compraraion al pasado
     *
     * @param Nada
     * @return renta año
     */
    public static function getMontoPromedioTicketsMes() {
        $consulta = "SELECT *"
                . "FROM V_INF_MON_TICK_PROM_MES";
        try {
            // Preparar sentencia
            $comando = oraconnect::getInstance()->getDb()->query($consulta);
            // Ejecutar sentencia preparada
            //$comando->execute(array($nombre));
            $comando->execute();
            $result = $comando->fetchAll(PDO::FETCH_ASSOC);
          
          return utf8_converter($result);
        } catch (PDOException $e) {
            return false;
        }
    }
    
    /**
     * Retorna datos de venta del dia detallado
     *
     * @param Nada
     * @return ventas del dia
     */
    public static function getDetalleVentasDia() {
        $consulta = "SELECT *"
                . "FROM V_INF_VENTAS_DIA_DET";
        try {
            // Preparar sentencia
            $comando = oraconnect::getInstance()->getDb()->query($consulta);
            // Ejecutar sentencia preparada
            //$comando->execute(array($nombre));
            $comando->execute();
            $result = $comando->fetchAll(PDO::FETCH_ASSOC);
            //print $comando;
            return utf8_converter($result);
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Retorna datos de venta de ayer
     *
     * @param Nada
     * @return ventas del dia
     */
    public static function getDetalleVentasAyer() {
        $consulta = "SELECT *"
                . "FROM V_INF_VENTAS_AYER_DET";
        try {
            // Preparar sentencia
            $comando = oraconnect::getInstance()->getDb()->query($consulta);
            // Ejecutar sentencia preparada
            //$comando->execute(array($nombre));
            $comando->execute();
            $result = $comando->fetchAll(PDO::FETCH_ASSOC);

            return utf8_converter($result);
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Retorna datos de venta de ayer
     *
     * @param Nada
     * @return ventas del dia
     */
    public static function getVentasMarca($p_fec_des, $p_fec_has) {
        $consulta = "SELECT COD_MARCA, MARCA,
                    SUM(VENTAS) VENTAS,
                    SUM(VENTAS_ANIO_PAST) VENTAS_ANIO_PAST,
                    ROUND(DECODE(NVL(SUM(VENTAS_ANIO_PAST), 0),
                                 0,
                                 DECODE(NVL(SUM(VENTAS), 0), 0, 0, 999),
                                 ((NVL(SUM(VENTAS), 0) - NVL(SUM(VENTAS_ANIO_PAST), 0)) /
                                 NVL(SUM(VENTAS_ANIO_PAST), 0)) * 100),
                          2) PORC
               FROM (
                     /*OPTIMA*/
                     SELECT  M.COD_MARCA,
                             M.DESCRIPCION MARCA,
                             ROUND(SUM(CASE
                                         WHEN V.FEC_ALTA BETWEEN
                                              TRUNC(TO_DATE('" . $p_fec_des . "', 'DD/MM/YYYY')) AND
                                              TRUNC(TO_DATE('" . $p_fec_has . "', 'DD/MM/YYYY')) THEN
                                          V.VENTA_NETA_GS
                                         ELSE
                                          0
                                       END)) VENTAS,
                             ROUND(SUM(CASE
                                         WHEN V.FEC_ALTA BETWEEN
                                              ADD_MONTHS((TRUNC(TO_DATE('" . $p_fec_des . "', 'DD/MM/YYYY'))),
                                                         -12) AND
                                              ADD_MONTHS(TRUNC(TO_DATE('" . $p_fec_has . "', 'DD/MM/YYYY')), -12) THEN
                                          V.VENTA_NETA_GS
                                         ELSE
                                          0
                                       END)) VENTAS_ANIO_PAST
                       FROM REL_MARCA_OP_GP M
                       JOIN VMATRIZ_VENTA_C_MAT V
                         ON M.COD_MARCA_OP = V.COD_MARCA
                      WHERE V.COD_VENDEDOR IN (SELECT DISTINCT VA.COD_VENDEDOR
                                               FROM EDS_VENDEDORES@GUATA VA
                                               WHERE VA.COD_EMPRESA = '2')
                      GROUP BY M.DESCRIPCION, M.COD_MARCA
                     UNION ALL
                     /*GP*/
                     SELECT M.COD_MARCA,
                            M.DESCRIPCION MARCA,
                            ROUND(SUM(CASE
                                        WHEN C.FEC_COMPROBANTE BETWEEN
                                             TRUNC(TO_DATE('" . $p_fec_des . "', 'DD/MM/YYYY')) AND
                                             TRUNC(TO_DATE('" . $p_fec_has . "', 'DD/MM/YYYY')) THEN
                                         C.TOTAL_GS
                                        ELSE
                                         0
                                      END)) VENTAS,
                            ROUND(SUM(CASE
                                        WHEN C.FEC_COMPROBANTE BETWEEN
                                             ADD_MONTHS((TRUNC(TO_DATE('" . $p_fec_des . "', 'DD/MM/YYYY'))),
                                                        -12) AND
                                             ADD_MONTHS(TRUNC(TO_DATE('" . $p_fec_has . "', 'DD/MM/YYYY')), -12) THEN
                                         C.TOTAL_GS
                                        ELSE
                                         0
                                      END)) VENTAS_ANIO_PAST
                       FROM REL_MARCA_OP_GP M
                       JOIN VVT_VTA_TOTAL_MAT@GUATA C
                         ON C.COD_MARCA = M.COD_MARCA_OP
                       WHERE C.COD_VENDEDOR IN (SELECT DISTINCT VA.COD_VENDEDOR
                                                FROM EDS_VENDEDORES@GUATA VA
                                                WHERE VA.COD_EMPRESA = '1')
                      GROUP BY M.DESCRIPCION, M.COD_MARCA)
              GROUP BY MARCA, COD_MARCA
              HAVING SUM(VENTAS) != 0 OR  SUM(VENTAS_ANIO_PAST) != 0
             ORDER BY 3 DESC
             ";
        //print $consulta;
        try {
            // Preparar sentencia
            $comando = oraconnect::getInstance()->getDb()->query($consulta);
            // Ejecutar sentencia preparada
            //$comando->execute(array($nombre));
            $comando->execute();
            $result = $comando->fetchAll(PDO::FETCH_ASSOC);

            return utf8_converter($result);
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function getDetalleVentasRubro($p_fec_des, $p_fec_has, $cod_marca) {
        $consulta = "SELECT COD_RUBRO,
                    RUBRO,
                    SUM(VENTAS) VENTAS,
                    SUM(VENTAS_ANIO_PAST) VENTAS_ANIO_PAST,
                    (SUM(VENTAS) - SUM(VENTAS_ANIO_PAST)) DIFERENCIA
               FROM (
                     /*OPTIMA*/
                     SELECT R.COD_RUBRO,
                             R.DESCRIPCION RUBRO,
                             ROUND(SUM(CASE
                                         WHEN V.FEC_ALTA BETWEEN
                                              TRUNC(TO_DATE('" . $p_fec_des . "', 'DD/MM/YYYY')) AND
                                              TRUNC(TO_DATE('" . $p_fec_has . "', 'DD/MM/YYYY')) THEN
                                          V.VENTA_NETA_GS
                                         ELSE
                                          0
                                       END)) VENTAS,
                             ROUND(SUM(CASE
                                         WHEN V.FEC_ALTA BETWEEN
                                              ADD_MONTHS((TRUNC(TO_DATE('" . $p_fec_des . "', 'DD/MM/YYYY'))),
                                                         -12) AND
                                              ADD_MONTHS(TRUNC(TO_DATE('" . $p_fec_has . "', 'DD/MM/YYYY')), -12) THEN
                                          V.VENTA_NETA_GS
                                         ELSE
                                          0
                                       END)) VENTAS_ANIO_PAST
                       FROM VMATRIZ_VENTA_C_MAT V
                       JOIN REL_MARCA_OP_GP M
                         ON V.COD_MARCA = M.COD_MARCA_OP
                       JOIN REL_RUBRO_OP_GP R
                         ON V.COD_RUBRO = R.COD_RUBRO_OP
                      WHERE M.COD_MARCA = ".trim($cod_marca)."
                        AND V.COD_VENDEDOR IN (SELECT DISTINCT VA.COD_VENDEDOR
                                               FROM EDS_VENDEDORES@GUATA VA
                                               WHERE VA.COD_EMPRESA = '2')
                      GROUP BY R.COD_RUBRO, R.DESCRIPCION
                     UNION ALL
                     /*GP*/
                     SELECT R.COD_RUBRO,
                            R.DESCRIPCION RUBRO,
                            ROUND(SUM(CASE
                                        WHEN C.FEC_COMPROBANTE BETWEEN
                                             TRUNC(TO_DATE('" . $p_fec_des . "', 'DD/MM/YYYY')) AND
                                             TRUNC(TO_DATE('" . $p_fec_has . "', 'DD/MM/YYYY')) THEN
                                         C.TOTAL_GS
                                        ELSE
                                         0
                                      END)) VENTAS,
                            ROUND(SUM(CASE
                                        WHEN C.FEC_COMPROBANTE BETWEEN
                                             ADD_MONTHS((TRUNC(TO_DATE('" . $p_fec_des . "', 'DD/MM/YYYY'))),
                                                        -12) AND
                                             ADD_MONTHS(TRUNC(TO_DATE('" . $p_fec_has . "', 'DD/MM/YYYY')), -12) THEN
                                         C.TOTAL_GS
                                        ELSE
                                         0
                                      END)) VENTAS_ANIO_PAST
                       FROM REL_MARCA_OP_GP M
                       JOIN VVT_VTA_TOTAL_MAT@GUATA C
                         ON C.COD_MARCA = M.COD_MARCA_GP
                       JOIN REL_RUBRO_OP_GP R
                         ON C.COD_RUBRO = R.COD_RUBRO_GP
                      WHERE M.COD_MARCA = ".trim($cod_marca)."
                        AND C.COD_VENDEDOR IN (SELECT DISTINCT VA.COD_VENDEDOR
                                               FROM EDS_VENDEDORES@GUATA VA
                                               WHERE VA.COD_EMPRESA = '1')
                      GROUP BY R.COD_RUBRO, R.DESCRIPCION)
              GROUP BY RUBRO, COD_RUBRO
             HAVING SUM(VENTAS) != 0 OR SUM(VENTAS_ANIO_PAST) != 0
             ORDER BY 3 DESC";
        //print $consulta;
        try {
            // Preparar sentencia
            $comando = oraconnect::getInstance()->getDb()->query($consulta);
            // Ejecutar sentencia preparada
            //$comando->execute(array($nombre));
            $comando->execute();
            $result = $comando->fetchAll(PDO::FETCH_ASSOC);

            return utf8_converter($result);
        } catch (PDOException $e) {
            return false;
        }
    }

     public static function getDetalleVentasVendedor($p_fec_des, $p_fec_has, $cod_marca, $cod_rubro) {
        $consulta = "SELECT COD_VENDEDOR,
                    NOM_VENDEDOR,
                    RUBRO,
                    COD_ZONA,
                    SUM(VENTAS_NETA) VENTAS_NETA,
                    SUM(CANTIDAD) CANTIDAD,
                    SUM(DEVOLUCION) DEVOLUCION,
                    SUM(VENTAS_BRUTA) VENTAS_BRUTA
               FROM (
                     /*OPTIMA*/
                     SELECT VA.COD_VENDEDOR,
                             VA.NOM_PERSONA NOM_VENDEDOR,
                             R.DESCRIPCION RUBRO,
                             V.COD_ZONA,
                             ROUND(SUM(DECODE(V.TIPO_COMPROBANTE, 'NCR', 0, V.VENTA_NETA_GS))) +
                             ROUND(SUM(DECODE(V.TIPO_COMPROBANTE, 'NCR', V.VENTA_NETA_GS, 0))) VENTAS_NETA,
                             ROUND(SUM(V.CANTIDAD)) CANTIDAD,
                             ROUND(SUM(DECODE(V.TIPO_COMPROBANTE, 'NCR', V.VENTA_NETA_GS, 0))) DEVOLUCION,
                             ROUND(SUM(DECODE(V.TIPO_COMPROBANTE, 'NCR', 0, V.VENTA_NETA_GS))) VENTAS_BRUTA
                       FROM VMATRIZ_VENTA_C_MAT V
                       JOIN REL_MARCA_OP_GP M
                         ON V.COD_MARCA = M.COD_MARCA_OP
                       JOIN REL_RUBRO_OP_GP R
                         ON V.COD_RUBRO = R.COD_RUBRO_OP
                       JOIN EDS_VENDEDORES@GUATA VA
                         ON V.COD_VENDEDOR = VA.COD_VENDEDOR
                        AND VA.COD_EMPRESA = '2'
                      WHERE M.COD_MARCA = '".trim($cod_marca)."'
                        AND R.COD_RUBRO = '".trim($cod_rubro)."'
                        AND V.FEC_ALTA BETWEEN TRUNC(TO_DATE('".$p_fec_des."', 'DD/MM/YYYY')) AND
                            TRUNC(TO_DATE('".$p_fec_has."', 'DD/MM/YYYY'))
                      GROUP BY VA.COD_VENDEDOR, VA.NOM_PERSONA, R.DESCRIPCION, V.COD_ZONA

                     UNION ALL 
                     /*GUATA*/
                     SELECT VA.COD_VENDEDOR,
                            VA.NOM_PERSONA NOM_VENDEDOR,
                            R.DESCRIPCION RUBRO,
                            C.ZONA,
                            ROUND(SUM(DECODE(S.SALDOS, 'R', 0, C.TOTAL_GS))) +
                            ROUND(SUM(DECODE(S.SALDOS, 'R', C.TOTAL_GS, 0))) VENTAS_NETA,
                            ROUND(SUM(C.CANTIDAD)) CANTIDAD,
                            ROUND(SUM(DECODE(S.SALDOS, 'R', C.TOTAL_GS, 0))) DEVOLUCION,
                            ROUND(SUM(DECODE(S.SALDOS, 'R', 0, C.TOTAL_GS))) VENTAS_BRUTA
                       FROM REL_MARCA_OP_GP M
                       JOIN VVT_VTA_TOTAL_MAT@GUATA C
                         ON C.COD_MARCA = M.COD_MARCA_GP
                       JOIN REL_RUBRO_OP_GP R
                         ON C.COD_RUBRO = R.COD_RUBRO_GP
                       JOIN TIPOS_COMPROBANTES@GUATA S
                         ON C.TIP_COMPROBANTE = S.TIP_COMPROBANTE
                        AND S.COD_MODULO = 'VT'
                        AND S.COD_EMPRESA = '1'
                       JOIN EDS_VENDEDORES@GUATA VA
                         ON C.COD_VENDEDOR = VA.COD_VENDEDOR
                        AND VA.COD_EMPRESA = '1'

                      WHERE M.COD_MARCA = '".trim($cod_marca)."'
                        AND R.COD_RUBRO = '".trim($cod_rubro)."'
                        AND C.FEC_COMPROBANTE BETWEEN
                            TRUNC(TO_DATE('".$p_fec_des."', 'DD/MM/YYYY')) AND
                            TRUNC(TO_DATE('".$p_fec_has."', 'DD/MM/YYYY'))

                      GROUP BY VA.COD_VENDEDOR, VA.NOM_PERSONA, R.DESCRIPCION, C.ZONA)
              GROUP BY COD_VENDEDOR,
                       NOM_VENDEDOR,
                       RUBRO,
                       COD_ZONA
              ORDER BY 3 DESC";
        //print $consulta;
        try {
            // Preparar sentencia
            $comando = oraconnect::getInstance()->getDb()->query($consulta);
            // Ejecutar sentencia preparada
            //$comando->execute(array($nombre));
            $comando->execute();
            $result = $comando->fetchAll(PDO::FETCH_ASSOC);

            return utf8_converter($result);
        } catch (PDOException $e) {
            return false;
        }
    }
    
    
        }

?>