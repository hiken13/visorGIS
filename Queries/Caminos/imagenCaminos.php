<?php

require './graficosCaminos.php';

header('Content-Type: image/png');

$x = $_GET['x'];
$y = $_GET['y'];
$zi = $_GET['zi'];
$graficos = new graficos();
$img = $graficos->crearImagen($x, $y,$zi);

echo imagepng($img);
imagedestroy($img);
?>