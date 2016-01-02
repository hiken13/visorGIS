<?php
    require './graficosHospitales.php';
//http://localhost/GIS/imagen.php?x=640&y=480&zi=1&mx=1&my=1
    header('Content-Type: image/png');
    
    $x=$_GET['x'];
    $y=$_GET['y'];
    $zi=$_GET['zi'];
    $mx=$_GET['mx'];
    $my=$_GET['my'];
    
    //http://localhost/GIS/imagen.php?x=1024&y=1024&zi=0.1&dir=der&vec=1
    $graficos= new graficos();
    $img=$graficos->crearImagen($x, $y,$zi,$mx,$my);

    echo imagepng($img);
    //imagedestroy($img);
?>