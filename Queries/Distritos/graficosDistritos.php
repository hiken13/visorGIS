<?php
class graficos {

    /**
     * 
     * @param int $x : Ancho
     * @param inty $y : Alto
     * @return image : i magen resultante
     */
    function crearImagen($x, $y) {
        $img = imagecreatetruecolor($x, $y);
        $fondo = imagecolorallocate($img, 0, 0, 0);
        $relleno = imagecolorallocate($img, 0, 255, 0);
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
        $strconn = "host=$host port=5433 dbname=$db user=$usr password=$pass";
        $conn = pg_connect($strconn) or die("Error de Conexion con la base de datos");
        //889283
        $query = " SELECT gid, ndistrito, (st_x( (ST_DumpPoints(geom)).geom )-283585)/514 as x, ((st_y( (ST_DumpPoints(geom)).geom )-889283)/514) As y FROM distritos where ndistrito not in( '', 'NA' ,'SIN NOMBRE')";

        $result = pg_query($conn, $query) or die("Error al ejecutar la consulta");

        $pila = array();
        $i = 0;
        $row = pg_fetch_row($result);
                
        $nombre = $row[1];
        $nombreAnterior = $row[1];
        imagefilledrectangle($img, 0, 0, $x, $y, $fondo);
        while ($row = pg_fetch_row($result)) {
            if ($nombreAnterior != $nombre) {
                imagefilledpolygon($img, $pila, count($pila) / 2, $relleno);
                $nombreAnterior = $row[1];
                $i = 0;
                $pila = array();
            }
            $nombre = $row[1];
            $pila[$i] = $row[2];
            $i++;
            $pila[$i] = (690-$row[3]);
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