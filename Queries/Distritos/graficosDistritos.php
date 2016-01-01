<?php
class graficos {

    /**
     * 
     * @param int $x : Ancho
     * @param inty $y : Alto
     * @return image : i magen resultante
     */
    function crearImagen($x, $y, $zi) {
        $factor= 366468.447793805/$x;
        $img = imagecreatetruecolor($x, $y);
        //$fondo = imagecolorallocate($img, 0, 0, 0);     
        $green = imagecolorallocatealpha($img, 52, 255, 27, 63);
        /*
          $trans = imagecolorallocatealpha($img, 255, 0, 0, 127);
          $red = imagecolorallocatealpha($img, 255, 0, 0, 50);
          $blue = imagecolorallocatealpha($img, 0, 0, 255, 63);


          imagefilltoborder($img, 0, 0, $trans, $trans);
          imagesavealpha($img, true);

          //imagefilledrectangle($img, 0, 0, 200, 200, $red);
          //imagefilledrectangle($img, 100, 100, 300, 300, $blue);
         */
        $host = 'localhost';
        $db = 'cursoGIS';
        $usr = 'postgres';
        $pass = '12345';
        $strconn = "host=$host port=5432 dbname=$db user=$usr password=$pass";
        $conn = pg_connect($strconn) or die("Error de Conexion con la base de datos");
        //889283
        $query = " SELECT gid, ndistrito, (st_x( (ST_DumpPoints(geom)).geom )-296480.57186013)/$factor as x, ((st_y( (ST_DumpPoints(geom)).geom )-889378.554139937)/$factor) As y FROM distritos where ndistrito not in( '', 'NA' ,'SIN NOMBRE')";

        $result = pg_query($conn, $query) or die("Error al ejecutar la consulta");

        $pila = array();
        $i = 0;
        $row = pg_fetch_row($result);
        
        
        $nombre = $row[1];
        $nombreAnterior = $row[1];
        
        while ($row = pg_fetch_row($result)) {
            $row[2]=  ajustar($row[2], $zi, $x);//////////
            $row[3]=  ajustar($row[3], $zi, $x);//////////
            if ($nombreAnterior != $nombre) {
                imagefilledpolygon($img, $pila, count($pila) / 2, $green);
                $nombreAnterior = $row[1];
                $i = 0;
                $pila = array();
            }
            $nombre = $row[1];
            $pila[$i] = $row[2];
            $i++;
            $pila[$i] = ($x-$row[3]);
            $i++;
        }
        //$pila = array(40,  50,20,  240, 60,  60,240, 20,50,  40,10,  10);
        //echo count($pila)/2;
        //print_r($pila);

        
        

        /*
          $pila = array();
          $i = 0;
          while ($row = pg_fetch_row($result)) {
          $pila[$i] = $row[0];
          $i++;
          }
          imagefilledpolygon($img, $pila, 374683, $red);
          ///
          $array = array(40,  50,  // Point 1 (x, y)
          20,  240, // Point 2 (x, y)
          60,  60,  // Point 3 (x, y)
          240, 20,  // Point 4 (x, y)
          50,  40,  // Point 5 (x, y)
          10,  10   // Point 6 (x, y)
          );
          while ($row = pg_fetch_row($result)) {
          imagefilledpolygon($img, $array, count($array), $red);
          } */

        //imagefilledellipse($img, $row[0], $row[1], 5, 5, $red);
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
    $punto = ($punto-($borde*($porcentaje*10))) + ($punto * $porcentaje); //expandir el punto de manera que se ajusat a las dimensiones
    return $punto;
}

