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
        <script type="text/javascript" src="./TableMaker.js"></script>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <meta charset="UTF-8">
        <title>GIS Vission</title>

    </head>
    <body class="bg-info">
        <div class="pull-left">
            <div class="btn-group" style=" top: 5%">            
                <a href="#" class="btn btn-default btn-sm disabled">Herramientas</a>  
            </div>  

            <div class="container" id="PanelHerramientas" style="background-color: gray; height:400px; width:225px;">
                <br>
                <table>
                    <tr ng-repeat="capa in capas|orderBy:'prioridad':true">
                        <td>
                            <h1 class="label label-default">{{capa.nombre}}</h1>
                        </td>
                        <td style="padding-left: 10px; padding-bottom: 2px">

                            <a href="#" class="btn-sm btn-default  glyphicon glyphicon-arrow-up" ng-click="bajar(capa.prioridad)"></a>                        
                            <a href="#" class="btn-sm btn-default  glyphicon glyphicon-arrow-down" ng-click="subir(capa.prioridad)"></a>                        
                            <a href="#" class="btn-sm btn-default " ng-class="capa.visible? 'glyphicon glyphicon-eye-open' : 'glyphicon glyphicon-eye-close'"
                               ng-click="controlarVisualizacion(capa.prioridad)"></a>                        
                        </td>
                    </tr>
                </table>                              
            </div>
        </div>          

        <div  style="background-color: gray;height:{{sizeY}}px; width:{{sizeX}}px; position: relative; left: 350px; top: 20px ">

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
                            <img   src="{{capa.url}}" width="{{sizeX}}" height="{{sizeY}}" />   
                        </td>
                    </tr>                   
                </table>
            </div>


        </div>
        <div id="panelBotones" style='position: absolute; top: 70%'>
            <div class="btn-group">
                <a class="btn btn-default btn-sm" ng-click="aumentarTransparencia()">op+</a>
                <a class="btn btn-default btn-sm" ng-click="zoomIn(1)">+</a>
                <a class="btn btn-default btn-sm" ng-click="zoomIn(0)">-</a>
                <a class="btn btn-default btn-sm" ng-click="zoomIn(2)">Reset</a>
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
