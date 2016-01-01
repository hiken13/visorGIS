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
 * @author 
 */
class graficos {

    /**
     * 
     * @param int $x : Ancho
     * @param inty $y : Alto
     * @return image : i magen resultante
     */
    function crearImagen($x, $y, $zi,$mx,$my) {
        $factor= 366468.447793805/$x;
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

        $query = "select 	(st_X(st_geometryN(geom,1))-292369.968163136)/$factor X,
	 $x- (st_y(st_geometryN(geom,1))-889242.988534586) /$factor  Y
        from escuelas";

        $result = pg_query($conn, $query) or die("Error al ejecutar la consulta");

        while ($row = pg_fetch_row($result)) {

            $row[0] = ajustar($row[0], $zi, $x);
            $row[1] = ajustar($row[1], $zi, $y);

            $row[0]+= ($x / 10) * $mx;//mover en x
            $row[1]+= ($y / 10) * $my;//mover en y
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
 * @param float dimension: dimenciones actuales del panel, dadas por x o y
 * @return punto : punto ajustado
 */
function ajustar($punto, $porcentaje,$dimension) {
    $borde = $dimension / 10; //10% de la dimension
    $punto = ($punto) + ($punto * $porcentaje); //ajustar el punto al porcentaje actual
    $punto = ($punto-($borde*($porcentaje*10))) + ($punto * $porcentaje); //expandir el punto de manera que se ajustar a las dimensiones
    return $punto;
}

