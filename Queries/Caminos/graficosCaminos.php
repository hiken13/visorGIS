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
        $white = imagecolorallocatealpha($img, 255, 248, 246, 63);
        imagefilltoborder($img, 0, 0, $trans, $trans);
        imagesavealpha($img, true);

        $host = 'localhost';
        $db = 'cursoGIS';
        $usr = 'postgres';
        $pass = '12345';

        $strconn = "host=$host port=5432 dbname=$db user=$usr password=$pass";
        $conn = pg_connect($strconn) or die("Error de Conexion con la base de datos");

        $query = "select c.gid gid,
          string_agg(CAST(((ST_X(ST_GeometryN(c.geom,1))-296480.57186013)/560.63136290052) as varchar(100)),', ') x,
          string_agg(CAST((640 - (ST_Y(ST_GeometryN(c.geom,1))-889378.554139937)/560.63136290052) as varchar(100)),', ') y
          from (select ((ST_DumpPoints((ST_GeometryN(geom,1)))).geom) geom, gid
          FROM caminos) c
          group by gid";

        $result = pg_query($conn, $query) or die("Error al ejecutar la consulta");

        while ($row = pg_fetch_row($result)) {

             {
                $arrayX = explode(", ", $row[1]);
                $arrayY = explode(", ", $row[2]);

                for ($i = 0; $i < count($arrayX) - 1; ++$i) {                
                    $x1 = ajustar($arrayX[$i], $zi);
                    $x2 = ajustar($arrayX[$i+1], $zi);
                    $y1 = ajustar($arrayY[$i], $zi);
                    $y2 = ajustar($arrayY[$i+1], $zi);
                    imageline($img, $x1, $y1, $x2, $y2, $white);
                }
            }
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
