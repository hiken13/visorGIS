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
    function crearImagen($x, $y, $zi, $mx, $my, $capa, $type, $X1, $Y1, $X2, $Y2, $filas, $columnas) {
        if ($type == "p") {
            return crearImagenPuntos($x, $y, $zi, $mx, $my, $capa, $X1, $Y1, $X2, $Y2, $filas, $columnas);
        } else if ($type == "l") {
            return crearImagenLineas($x, $y, $zi, $mx, $my, $capa, $X1, $Y1, $X2, $Y2, $filas, $columnas);
        } else if ($type == "po") {
            return crearImagenPoligono($x, $y, $zi, $mx, $my, $capa, $X1, $Y1, $X2, $Y2, $filas, $columnas);
        }
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
function ajustar($punto, $nivel, $dimension, $m) {

    $i = $nivel; //nivel actual de zoom
    $dimension = mover($nivel, $dimension);
    while ($i > 0) {
        $punto = $punto + $punto * 0.1;
        $punto = $punto - $dimension * 0.1;
        $i-=1;
    }
    $punto -= ($dimension / 10) * $m;
    return $punto;
}

function mover($nivel, $dimension) {
    while ($nivel > 0) {
        $dimension = $dimension - $dimension * 0.1;
        $nivel--;
    }
    return $dimension;
}

/**
 * 
 * @param type $x dimension en x
 * @param type $y dimension en y
 * @param type $zi cantidad de zoom
 * @param type $mx movimientos solicitados en x
 * @param type $my movimientos solicitados en y
 * @param type $capa nombre de la capa que solicita
 * @return type.
 */
function crearImagenPuntos($x, $y, $zi, $mx, $my, $capa, $X1, $Y1, $X2, $Y2, $filas, $columnas) {
    $factor = 366468.447793805 / $x; //factor de division respecto a las divisiones
    $img = imagecreatetruecolor($x, $y);

    $trans = imagecolorallocatealpha($img, 255, 255, 255, 127);
    $red = imagecolorallocatealpha($img, 255, 0, 0, 63);
    $blue = imagecolorallocatealpha($img, 0, 0, 255, 63);
    $green = imagecolorallocatealpha($img, 52, 255, 27, 63);
    imagefilltoborder($img, 0, 0, $trans, $trans);
    imagesavealpha($img, true);

    if ($capa == "hospitales") {
        $color = $red;
        $size = 10;
    } else {
        $color = $green;
        $size = 6;
    }

    $host = 'localhost';
    $db = 'cursoGIS';
    $usr = 'postgres';
    $pass = '12345';

    $strconn = "host=$host port=5432 dbname=$db user=$usr password=$pass";
    $conn = pg_connect($strconn) or die("Error de Conexion con la base de datos");

    $query = "select (st_X(st_geometryN(geom,1))-283585.639702539)/$factor X,
          $x- (st_y(st_geometryN(geom,1))-889378.554139937)/$factor  Y
          from $capa";

    $result = pg_query($conn, $query) or die("Error al ejecutar la consulta");

    while ($row = pg_fetch_row($result)) {
        $row[0] = ajustar($row[0], $zi, $x, $mx);
        $row[1] = ajustar($row[1], $zi, $y, $my);
        imagefilledellipse($img, $row[0], $row[1], $size, $size, $color);
    }
    return ($img);
}

function crearImagenLineas($x, $y, $zi, $mx, $my, $capa, $X1, $Y1, $X2, $Y2, $filas, $columnas) {
    $factor = 366468.447793805 / $x;
    $img = imagecreatetruecolor($x, $y);

    $trans = imagecolorallocatealpha($img, 255, 255, 255, 127);
    $red = imagecolorallocatealpha($img, 255, 0, 0, 63);
    $blue = imagecolorallocatealpha($img, 0, 0, 255, 63);
    $white = imagecolorallocatealpha($img, 255, 248, 246, 63);

    if ($capa == "rios") {
        $color = $blue;
    } else if ($capa == "caminos") {
        $color = $white;
    }
    imagefilltoborder($img, 0, 0, $trans, $trans);
    imagesavealpha($img, true);


    $host = 'localhost';
    $db = 'cursoGIS';
    $usr = 'postgres';
    $pass = '12345';

    $strconn = "host=$host port=5432 dbname=$db user=$usr password=$pass";
    $conn = pg_connect($strconn) or die("Error de Conexion con la base de datos");

    $query = "select r.gid gid,
	string_agg(CAST(((ST_X(ST_GeometryN(r.geom,1))-283585.639702539)/$factor) as varchar(100)),', ') x,
	string_agg(CAST(($x - (ST_Y(ST_GeometryN(r.geom,1))-889378.554139937)/$factor) as varchar(100)),', ') y
from (select ((ST_DumpPoints((ST_GeometryN(geom,1)))).geom) geom, gid 
	FROM $capa) r
	group by gid";

    $result = pg_query($conn, $query) or die("Error al ejecutar la consulta");

    while ($row = pg_fetch_row($result)) {
        $arrayX = explode(", ", $row[1]);
        $arrayY = explode(", ", $row[2]);

        for ($i = 0; $i < count($arrayX) - 1; ++$i) {
            $x1 = ajustar($arrayX[$i], $zi, $x, $mx);
            $x2 = ajustar($arrayX[$i + 1], $zi, $x, $mx);
            $y1 = ajustar($arrayY[$i], $zi, $y, $my);
            $y2 = ajustar($arrayY[$i + 1], $zi, $y, $my);

            imageline($img, $x1, $y1, $x2, $y2, $color);
        }
    }

    return ($img);
}

function crearImagenPoligono($x, $y, $zi, $mx, $my, $capa, $X1, $Y1, $X2, $Y2, $filas, $columnas) {
    $factor = 366468.447793805 / $x;
    $img = imagecreatetruecolor($x, $y);

    $green = imagecolorallocatealpha($img, 52, 255, 27, 63);

    $host = 'localhost';
    $db = 'cursoGIS';
    $usr = 'postgres';
    $pass = '12345';
    $strconn = "host=$host port=5432 dbname=$db user=$usr password=$pass";
    $conn = pg_connect($strconn) or die("Error de Conexion con la base de datos");
    //889283
    $query1 = "SELECT gid, ndistrito, st_astext(geom) as geom FROM (SELECT gid, ndistrito, geom FROM distritos where geom && ST_SetSRID(ST_MakeBox2D(ST_Point( 283585.639702539 + (((658921.833302539 - 283585.639702539)/$filas)*$X1), 1241131.13684006 - (((1241131.13684006 - 889283.653040062)/$columnas)*$Y1) ),ST_Point( 283585.639702539 + (((658921.833302539 - 283585.639702539)/$filas)*$X2), 1241131.13684006 - (((1241131.13684006 - 889283.653040062)/$columnas)*$Y2) )), 5367) and ndistrito not in('', 'NA')) con";

    $result1 = pg_query($conn, $query1) or die("Error al ejecutar la consulta");

    $pila = array();
    $i = 0;
    $row1 = pg_fetch_all($result1);
    
    /*
     *imagefilledrectangle($img, 0, 0, $x, $y, $fondo);
      $query = " SELECT gid, ndistrito, (st_x( (ST_DumpPoints(geom)).geom )-283585.639702539)/$factor as x,$x- ((st_y( (ST_DumpPoints(geom)).geom )-889378.554139937)/$factor) As y FROM $capa where ndistrito not in( '', 'NA' ,'SIN NOMBRE')";

      $result = pg_query($conn, $query) or die("Error al ejecutar la consulta");

      $pila = array();
      $i = 0;
      $row = pg_fetch_row($result);
     

    $nombre = $row[1];
    $nombreAnterior = $row[1];

    while ($row = pg_fetch_row($result)) {
        $row[2] = ajustar($row[2], $zi, $x, $mx);
        $row[3] = ajustar($row[3], $zi, $y, $my);

        if ($nombreAnterior != $nombre) {
            imagefilledpolygon($img, $pila, count($pila) / 2, $green);
            $nombreAnterior = $row[1];
            $i = 0;
            $pila = array();
        }
        $nombre = $row[1];
        $pila[$i] = $row[2];
        $i++;
        $pila[$i] = ($row[3]);
        $i++;
    }*/
    
    foreach ($row1 as &$valor) {
        $geom = $valor["geom"];
        //echo $geom;
        $query2 = "SELECT ( st_x( (ST_DumpPoints(geom)).geom )-(283585.639702539 + (((658921.833302539 - 283585.639702539)/$filas)*$X1) ) )/$factor as x, $x-(st_y( (ST_DumpPoints(geom)).geom )-(889283.653040062 - (((1241131.13684006 - 889283.653040062)/$columnas)*$Y2) ) )/$factor as y FROM ST_GeomFromText('$geom') as geom";
        $result2 = pg_query($conn, $query2) or die("Error al ejecutar la consulta 2");

        while ($row2 = pg_fetch_row($result2)) {
            $row2[0] = ajustar($row2[0], $zi, $x, $mx);
            $row2[1] = ajustar($row2[1], $zi, $y, $my);
            $pila[$i] = $row2[0];
            $i++;
            $pila[$i] = $row2[1];
            $i++;
        }
        imagefilledpolygon($img, $pila, count($pila) / 2, $green);
        unset($pila);
        $pila = array();
        $i = 0;
    }
    return ($img);
}
