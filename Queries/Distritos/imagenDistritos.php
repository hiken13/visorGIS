<?php
//http://localhost:trunk/Queries/Distritos/imagenDistritos.php?x=1280&y=630
require './graficosDistritos.php';

header('Content-Type: image/png');

$x = $_GET['x'];
$y = $_GET['y'];
$zi = $_GET['zi'];
$graficos = new graficos();
$img = $graficos->crearImagen($x, $y,$zi);

echo imagepng($img);
imagedestroy($img);
?>