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
    function crearImagen($x, $y, $zi, $mx, $my) {
        $factor = 366468.447793805 / $x;
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
            $x3 = $x;
            $y3 = $y;
            $x3 = mover($zi, $x3);
            $y3 = mover($zi, $y3);
            $row[0]-= ($x3 / 10) * $mx;
            $row[1]-= ($y3 / 10) * $my;
            //$row[0]+= ($row[0] / 10) * $mx;//mover en x
            // $row[1]+= ($row[1] / 10) * $my;//mover en y
            imagefilledellipse($img, $row[0], $row[1], 6, 6, $green);
        }

        return ($img);
    }

}

/**
 * Funcion para ajustar los puntos devueltos por la consulta extendiendolos un 10% con
 * respecto a su distancia actual
 * @param int punto: punto para ajustar
 * @param float nivel: nivel de zoom
 * @param float dimension: dimenciones actuales del panel, dadas por x o y
 * @return punto : punto ajustado
 */
function ajustar($punto, $nivel, $dimension) {

    $i = $nivel; //nivel actual de zoom
    while ($i > 0) {
        $dimension = $dimension - $dimension * 0.1;
        $punto = $punto + $punto * 0.1;
        $punto = $punto - $dimension * 0.1;
        $i-=1;
    }


    return $punto;
}

function mover($nivel, $dimension) {
    while ($nivel > 0) {
        $dimension = $dimension - $dimension * 0.1;
        $nivel--;
    }
    return $dimension;
}
