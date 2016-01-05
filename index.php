<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html ng-app="visorGIS" ng-controller="ControllerViewerGIS">
    <head >


        <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.7/angular.min.js"></script>
        <script src="./Controllers/ViewerController.js"></script>
        <script type="text/javascript" src="./TableMaker.js"></script>


        <!--link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"-->
        <meta charset="UTF-8">
        <title>GIS Vission</title>

    </head>
    <body class="bg-info" style="background-color: rgb(29,31,33)">
        <div style="height:100%;" class="pull-left">
            <div class="btn-group" style=" top: 5%">
            </div>  

            <div class="container" id="PanelHerramientas" style="background-color: gray; height:720px; width:300px;">
                <br>
                <table>
                    <tr ng-repeat="capa in capas|orderBy:'prioridad':true">
                        <td>
                            <h1 class="label label-default">{{capa.nombre}}</h1>
                        </td>
                        <td style="padding-left: 10px; padding-bottom: 2px">

                            <a href="#" class="btn-sm btn-default  glyphicon glyphicon-arrow-up" ng-click="bajar(capa.prioridad)"></a>                        
                            <a href="#" class="btn-sm btn-default  glyphicon glyphicon-arrow-down" ng-click="subir(capa.prioridad)"></a>                        
                            <a class="btn btn-default btn-sm" ng-click="aumentarTransparencia(capa.prioridad, 1)">tr+</a>
                            <a class="btn btn-default btn-sm" ng-click="aumentarTransparencia(capa.prioridad, 0)">tr-</a>
                            <a href="#" class="btn-sm btn-default " ng-class="capa.visible ? 'glyphicon glyphicon-eye-open' : 'glyphicon glyphicon-eye-close'"
                               ng-click="controlarVisualizacion(capa.prioridad)"></a>                        
                        </td>
                    </tr>
                </table>
                <hr class="divider">
                <div id="panelBotones" >
                    <a class="btn btn-default btn-sm" ng-click="zoomIn(2)">Reset</a>                
                </div>
                <h1 class="label label-primary"> Zoom </h1>
                <div style="margin: 2%" class="btn-group">                
                    <a class="btn btn-default btn-sm" ng-click="zoomIn(1)">+</a>
                    <a class="btn btn-default btn-sm" ng-click="zoomIn(0)">-</a>
                    <!--a href="#" class="btn btn-default btn-sm" ng-click="cambiarTam()">Cambiar tamaño</a-->  
                </div>
                <div>
                    <h1 class="label label-primary">Dimension</h1>

                    <select style="margin: 2%" ng-model="selected" ng-options="opt as opt for opt in months" ng-init="selected = '300x300'"></select>
                    <!--h3>You have selected : {{selected}}</h3-->
                </div>
                <table>
                    <tr>
                        <td></td>
                        <td><a class="btn btn-default btn-sm  glyphicon glyphicon-chevron-up" ng-click="mov(1)"></a></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><a class="btn btn-default btn-sm  glyphicon glyphicon-chevron-left" ng-click="mov(4)"></a></td>
                        <td></td>
                        <td><a class="btn btn-default btn-sm  glyphicon glyphicon-chevron-right" ng-click="mov(3)"></a></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><a class="btn btn-default btn-sm  glyphicon glyphicon-chevron-down" ng-click="mov(0)"></a></td>
                        <td></td>
                    </tr>
                </table>
                <div>
                <table style="margin: 2%">
                    <tr>
                            <td>
                                <input id="rows" type="text" class="form-control" placeholder="Filas" aria-describedby="basic-addon1" disabled>
                            </td>
                            <td>
                                <button onclick="add('r')" type="button" class="btn btn-default btn-default">
                                    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                                </button>
                            </td>
                            <td>
                                <button onclick="sub('r')" type="button" class="btn btn-default btn-default">
                                    <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input id="columns" type="text" class="form-control" placeholder="Columnas" aria-describedby="basic-addon1" disabled>
                            </td>
                            <td>
                                <button onclick="add('c')" type="button" class="btn btn-default btn-default">
                                    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                                </button>
                            </td>
                            <td>
                                <button onclick="sub('c')" type="button" class="btn btn-default btn-default">
                                    <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span>
                                </button>
                            </td>
                        </tr>
                </table>
            </div>
            </div>
            
        </div>          

        <div  style="background-color: gray;height:{{sizeY}}px; width:{{sizeX}}px; position: relative; left: 310px; top: 20px ">

            <div ng-repeat="capa in capas">
                <table style="position: absolute" ng-show="capa.visible">
                    <tr>
                        <td>

                            <img style="opacity: {{capa.opacidad}}"   src="{{capa.url}}" width="{{sizeX}}" height="{{sizeY}}" />   

                        </td>
                    </tr>                   
                </table>            
            </div>  

        </div>


    </body>
</html>
