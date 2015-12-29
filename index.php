<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html ng-app="visorGIS" ng-controller="ControllerViewerGIS">
    <head >
        <link rel="stylesheet" href="imagepanner.css" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="jquery.kinetic.min.js" type="text/javascript"></script>
        <script src="jquery.mousewheel.min.js"></script>
        <script src="imagepanner.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.7/angular.min.js"></script>
        <script src="./Controllers/ViewerController.js"></script>
        <script type="text/javascript" src="./TableMaker.js"></script>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <meta charset="UTF-8">
        <title>GIS Vission</title>

        <style>

            /* demo styles. Remove if desired */
            #pcontainer1{
                width: 600px;
                height: 400px;
            }

            @media screen and (max-width: 780px){ /* responsive setting */
                #pcontainer1{
                    width: 100%;
                    height: 400px;
                }
            }

        </style>

        <script>

            var panimage1; // register arbitrary variable
            jQuery(function ($) {
                panimage1 = new imagepanner({
                    wrapper: $('#pcontainer1'), // jQuery selector to image container
                    imgpos: [100, 300], // initial image position- x, y
                    maxlevel: 4 // maximum zoom level
                });
            });

        </script>   
    </head>
    <body class="bg-info">
        <div class="pull-left">
            <div class="btn-group" style=" top: 5%">            
                <a href="#" class="btn btn-default btn-sm">Herramientas</a>  
            </div>  

            <div class="container" id="PanelHerramientas" style="background-color: gray; height:400px; width:200px;">
                <br>
                <table>
                    <tr ng-repeat="capa in capas |orderBy:'prioridad':true">
                        <td>
                            <a href="#" class="btn btn-default btn-sm" ng-click="controlarVisualizacion(capa.prioridad)">{{capa.nombre}}</a>
                        </td>
                        <td>

                            <a href="#" class=" btn-default  glyphicon glyphicon-arrow-up" ng-click="bajar(capa.prioridad)"></a>                        
                            <a href="#" class=" btn-default  glyphicon glyphicon-arrow-down" ng-click="subir(capa.prioridad)"></a>                        
                        </td>
                    </tr>
                </table>                              
            </div>
        </div>          

        <div  style="background-color: gray; height:{{sizeY}}px; width:{{sizeX}}px; position: relative; left: 350px; top: 20px ">

            <div ng-repeat="capa in capas">
                <table style="position: absolute" ng-show="capa.visible">
                    <tr>
                        <td>
                            <img  src="{{capa.url}}" width="{{sizeX}}" height="{{sizeY}}" />   
                        </td>
                    </tr>                   
                </table>            
            </div>
            <div ng-repeat="capa in capas">
                <table style="position: absolute" ng-show="capa.visible">
                    <tr>
                        <td>
                            <img  src="{{capa.url}}" width="{{sizeX}}" height="{{sizeY}}" />   
                        </td>
                    </tr>                   
                </table>
            </div>

            <div ng-repeat="capa in capas" ng-show="capa.visible">
                <table style="position: absolute">
                    <tr>
                        <td>
                            <img  src="{{capa.url}}" width="{{sizeX}}" height="{{sizeY}}" />   
                        </td>
                    </tr>                   
                </table>
            </div>


        </div>
        <div id="panelBotones" style='position: absolute; top: 70%'>
            <div class="btn-group">
                <a class="btn btn-default btn-sm" onClick="panimage1.zoom(1)">reset</a>                       
                <a href="#" class="btn btn-default btn-sm" ng-click="cambiarTam()">Cambiar tamaño</a>  
            </div>

        </div>


        <?php
        // put your code here
        ?>
        <div id="myDynamicTable">
        </div>
        <script>
                    addTable();
        </script>
    </body>
</html>
