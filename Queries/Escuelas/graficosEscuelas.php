<?php

//namespace graficos;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of newPHPClass
 *
 * @author leoviquez
 */
class graficos {

    /**
     * 
     * @param int $x : Ancho
     * @param inty $y : Alto
     * @return image : i magen resultante
     */
    function crearImagen($x, $y, $zi) {
        $img = imagecreatetruecolor($x, $y);

        $trans = imagecolorallocatealpha($img, 255, 255, 255, 127);
        $green = imagecolorallocatealpha($img, 52, 255, 27, 63);
        imagefilltoborder($img, 0, 0, $trans, $trans);
        imagesavealpha($img, true);

        //       imagefilledrectangle($img, 0, 0, 200, 200, $red);
//        imagefilledrectangle($img, 100, 100, 300, 300, $blue);

        $host = 'localhost';
        $db = 'cursoGIS';
        $usr = 'postgres';
        $pass = '12345';

        $strconn = "host=$host port=5432 dbname=$db user=$usr password=$pass";
        $conn = pg_connect($strconn) or die("Error de Conexion con la base de datos");

        $query = "select 	(st_X(st_geometryN(geom,1))-292369.968163136)/564.017324260508 X,
	 640- (st_y(st_geometryN(geom,1))-889242.988534586) /564.017324260508  Y
        from escuelas";

        $result = pg_query($conn, $query) or die("Error al ejecutar la consulta");

        while ($row = pg_fetch_row($result)) {

            $row[0] = ajustar($row[0], $zi);
            $row[1] = ajustar($row[1], $zi);
            imagefilledellipse($img, $row[0], $row[1], 6, 6, $green);
        }

        return ($img);
    }
}

/**
 * Funcion para ajustar los puntos devueltos por la consulta extendiendolos un 10% con
 * respecto a su distancia actual
 * @param int punto: punto para ajustar
 * @param float porcentaje: porcentaje de zoom
 * @return punto : punto ajustado
 */
function ajustar($punto, $porcentaje) {
    //$seg = $dimension / 10; //10% de la dimension
    $punto = ($punto) + ($punto * $porcentaje); //expandir el punto
    return $punto;
}
