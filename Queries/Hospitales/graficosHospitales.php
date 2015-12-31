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
        $red = imagecolorallocatealpha($img, 255, 0, 0, 63);
        $blue = imagecolorallocatealpha($img, 0, 0, 255, 63);
        $green = imagecolorallocatealpha($img, 52, 255, 27, 63);
        imagefilltoborder($img, 0, 0, $trans, $trans);
        imagesavealpha($img, true);

        $host = 'localhost';
        $db = 'cursoGIS';
        $usr = 'postgres';
        $pass = '12345';

        $strconn = "host=$host port=5432 dbname=$db user=$usr password=$pass";
        $conn = pg_connect($strconn) or die("Error de Conexion con la base de datos");


        $query = "select 	(st_X(st_geometryN(geom,1))-296480.57186013)/560.63136290052 X,
          640- (st_y(st_geometryN(geom,1))-889378.554139937)/560.63136290052  Y
          from hospitales";


        $result = pg_query($conn, $query) or die("Error al ejecutar la consulta");

        while ($row = pg_fetch_row($result)) {
            if ($zi != "n") {
                $row[0] = ajustar($row[0], $x);
                $row[1] = ajustar($row[1], $y);
                imagefilledellipse($img, $row[0], $row[1], 10, 10, $red);
            } else {
                imagefilledellipse($img, $row[0], $row[1], 10, 10, $red);
            }
        }


        return ($img);
    }

}

/**
 * Funcion para ajustar los puntos devuelto por la consulta al tamaño de la imagen
 * @param int $x : punto para ajustar
 * @param inty $y : dimensiones a las que se debe ajustar el punto
 * @return punto : punto ajustado
 */
function ajustar($punto, $porcentaje) {
    //$seg = $dimension / 10; //10% de la dimension
    $punto = ($punto) + ($punto * porcentaje); //expandir el punto
    return $punto;
}
