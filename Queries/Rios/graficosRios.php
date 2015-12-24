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
class graficos 
{
    /**
     * 
     * @param int $x : Ancho
     * @param inty $y : Alto
     * @return image : i magen resultante
     */
    
    function crearImagen ($x,$y)
    {
        $img = imagecreatetruecolor($x,$y);

        $trans = imagecolorallocatealpha($img, 255, 255, 255, 127);
        $red = imagecolorallocatealpha($img, 255, 0, 0, 63);
        $blue = imagecolorallocatealpha($img, 0, 0, 255, 63);
        imagefilltoborder($img, 0, 0, $trans, $trans);
        imagesavealpha($img, true);


        $host='localhost';
        $db='cursoGIS';
        $usr='postgres';
        $pass='12345';
        
        $strconn = "host=$host port=5432 dbname=$db user=$usr password=$pass";
        $conn = pg_connect($strconn) or die("Error de Conexion con la base de datos");
        
        $query="select  (ST_X(ST_GeometryN(r.geom,1))-292369.968163136)/564.017324260508 x,
	640 - (ST_Y(ST_GeometryN(r.geom,1))-889242.988534586) /564.017324260508 y
from (select ((ST_DumpPoints((ST_GeometryN(geom,1)))).geom) geom 
	from rios) r";
        
        
        
        $result = pg_query($conn, $query) or die("Error al ejecutar la consulta");

        while ($row=pg_fetch_row($result))
        {
            //imagefilledellipse($img, $row[0], $row[1], 10, 10, $red);
           imagefilledellipse($img, $row[0], $row[1], 1, 1, $blue);
        }

        return ($img);
    }
            
}
