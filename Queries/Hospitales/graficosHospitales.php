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

//        imagefilledrectangle($img, 0, 0, 200, 200, $red);
//        imagefilledrectangle($img, 100, 100, 300, 300, $blue);

        $host='localhost';
        $db='cursoGIS';
        $usr='postgres';
        $pass='12345';
        
        $strconn = "host=$host port=5432 dbname=$db user=$usr password=$pass";
        $conn = pg_connect($strconn) or die("Error de Conexion con la base de datos");
        $query="select 	(st_X(st_geometryN(geom,1))-340735.03802508)/430.145515478705 X,
	(st_y(st_geometryN(geom,1))-955392.16848899)/430.145515478705 Y
        from hospitales";
        $result = pg_query($conn, $query) or die("Error al ejecutar la consulta");

        while ($row=pg_fetch_row($result))
        {
            imagefilledellipse($img, $row[0], $row[1], 10, 10, $red);
        }

        return ($img);
    }
            
}
