<?php
//http://localhost:8000/Queries/Distritos/imagenDistritos.php?x=1280&y=630
require './graficosDistritos.php';

header('Content-Type: image/png');

$x = $_GET['x'];
$y = $_GET['y'];

$graficos = new graficos();
$img = $graficos->crearImagen($x, $y);

echo imagepng($img);
imagedestroy($img);
?>