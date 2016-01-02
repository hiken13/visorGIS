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
        $factor = 366468.447793805 / $x;
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
          string_agg(CAST(((ST_X(ST_GeometryN(c.geom,1))-296480.57186013)/$factor) as varchar(100)),', ') x,
          string_agg(CAST(($x - (ST_Y(ST_GeometryN(c.geom,1))-889378.554139937)/$factor) as varchar(100)),', ') y
          from (select ((ST_DumpPoints((ST_GeometryN(geom,1)))).geom) geom, gid
          FROM caminos) c
          group by gid";

        $result = pg_query($conn, $query) or die("Error al ejecutar la consulta");

        while ($row = pg_fetch_row($result)) {


            $arrayX = explode(", ", $row[1]);
            $arrayY = explode(", ", $row[2]);

            for ($i = 0; $i < count($arrayX) - 1; ++$i) {
            $x1 = ajustar($arrayX[$i], $zi, $x,$mx);
                $x2 = ajustar($arrayX[$i + 1], $zi, $x,$mx);
                $y1 = ajustar($arrayY[$i], $zi, $y,$my);
                $y2 = ajustar($arrayY[$i + 1], $zi, $y,$my);
                
                /*$xAux = $x;
                $yAux = $y;
                $xAux = mover($zi, $xAux);
                $yAux = mover($zi, $yAux);

                
                $x1-= ($xAux / 10) * $mx;
                $x2-= ($xAux / 10) * $mx;
                $y1-= ($yAux / 10) * $my;
                $y2-= ($yAux / 10) * $my;*/
                imageline($img, $x1, $y1, $x2, $y2, $white);
            }
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
function ajustar($punto, $nivel, $dimension,$m) {

    $i = $nivel; //nivel actual de zoom
    $dimension = mover($nivel, $dimension);
    while ($i > 0) {
        $punto = $punto + $punto * 0.1;
        $punto = $punto - $dimension * 0.1;
        $i-=1;
    }
    $punto -= ($dimension/10) * $m;
    return $punto;
}

/**
 *Funcion Auxiliar para mover que retorna las dimensiones actuales del nivel de acercamiento
 * @param type $nivel nivel de zoom actual
 * @param type $dimension dimension a actualizar deacuerdo al nivel de zoom
 * @return type
 */
function mover($nivel, $dimension) {
    while ($nivel > 0) {
        $dimension = $dimension - $dimension * 0.1;
        $nivel--;
    }
    return $dimension;
}