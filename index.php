<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html ng-app="visorGIS" ng-controller="ControllerViewerGIS">
    <head >
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.7/angular.min.js"></script>
        <script src="./Controllers/ViewerController.js"></script>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <meta charset="UTF-8">
        <title>GIS Vission</title>
    </head>
    <center>
        <body class="bg-info">
            <div class="pull-left">
                <div class="btn-group" style=" top: 5%">            
                    <a href="#" class="btn btn-default btn-sm">Herramientas</a>  

                </div>  

                <div class="container" id="PanelHerramientas" style="background-color: gray; height:400px; width:200px;">
                    <br>
                    <a href="#" class="btn btn-default btn-sm" ng-click="cargarHospitales()">{{capaHospTxt}}</a>
                </div>
            </div>          

            <div ng-view="vistaPanel"  class="" id="Panel" style="background-color: gray; height:{{sizeY}}px; width:{{sizeX}}px; position: absolute; left: 300px; top: 20px">
                <center>
                    <img style="position: inherit" ng-show="capaHosp" src="Queries/Hospitales/imagenHospitales.php?x={{sizeX}}&y={{sizeY}}">                    
                </center>
            </div>
            <div id="panelBotones" style='position: absolute; top: 70%'>
                <div class="btn-group">            
                    <a href="#" class="btn btn-default btn-sm glyphicon glyphicon-plus"></a>
                    <a href="#" class="btn btn-default btn-sm glyphicon glyphicon-minus"></a>               
                    <a href="#" class="btn btn-default btn-sm" ng-click="cambiarTam()">Cambiar tamaño</a>  
                </div>
                <br>
                <a href="#" class="btn btn-default btn-sm glyphicon  glyphicon-arrow-up"></a>
                <div>
                    <a href="#" class="btn btn-default btn-sm glyphicon glyphicon-arrow-left"></a>
                    <a href="#" class="btn btn-default btn-sm glyphicon glyphicon-arrow-right"></a>
                </div>
                <a href="#" class="btn btn-default btn-sm glyphicon glyphicon-arrow-down"></a>
            </div>


            <?php
            // put your code here
            ?>
        </body>
</html>
