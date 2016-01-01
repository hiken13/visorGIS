<?php

require './graficosHospitales.php';

header('Content-Type: image/png');

$x = $_GET['x'];
$y = $_GET['y'];
$zi = $_GET['zi'];
$mx = $_GET['mx'];
$my = $_GET['my'];

$graficos = new graficos();
$img = $graficos->crearImagen($x, $y, $zi,$mx,$my);

echo imagepng($img);
imagedestroy($img);
?>