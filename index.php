<!DOCTYPE html>
<html ng-app="visorGIS" ng-controller="ControllerViewerGIS">
    <head >

        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.1/angular.min.js"></script>
        <script src="angular-fullscreen.js"></script>
        <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <script src="./Controllers/ViewerController.js"></script>
        <script type="text/javascript" src="./TableMaker.js"></script>


        <!--link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"  rgb(29,31,33)-->
        <meta charset="UTF-8">
        <title>GIS Vission</title>

    </head>
    <body id="body" class="" style="background-color: rgb(29,31,33)">
        <div Fullscreen></div >
        <div style="padding: 1%; background-color: gray; height:100%; width: 25%;" class="pull-left">
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
            <center>
                <div id="panelBotones" style="margin: 1%">
                    <button class="btn btn-default btn-sm glyphicon glyphicon-fullscreen" ng-click="goFullscreen()"></button>

                    <a class="btn btn-default btn-sm glyphicon" ng-click="zoomIn(2)">Reset</a>                
                </div>


                <table style="margin: 1%">
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

                <table style="margin: 2%;width: 63%">
                    <tr>
                        <td >
                            <input  id="rows" type="text" class="form-control" placeholder="Filas" aria-describedby="basic-addon1" disabled ng-model="filas">
                        </td>
                        <td>
                            <button ng-click="addRow()"  type="button" class="btn btn-default btn-default">
                                <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                            </button>
                        </td>
                        <td>
                            <button ng-click="subRow()" type="button" class="btn btn-default btn-default">
                                <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td >
                            <input  id="columns" type="text" class="form-control" placeholder="Columnas" aria-describedby="basic-addon1" disabled ng-model="columnas">
                        </td>
                        <td>
                            <button ng-click="addColumn()" type="button" class="btn btn-default btn-default">
                                <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                            </button>
                        </td>
                        <td>
                            <button ng-click="subColumn()" type="button" class="btn btn-default btn-default">
                                <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span>
                            </button>
                        </td>
                    </tr>
                </table>
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

            </center>
        </div>

        

        <div style="background-color: gray;height:{{sizeY}}px; width:{{sizeX}}px; position: relative; left: 25.4%; margin-top: 1%;">

            <div ng-repeat="capa in capas">
                <div style="position: absolute" ng-show="capa.visible">
                    <table>
                        <tr ng-repeat="i in arrayFilas">
                            <td ng-repeat="j in arrayColumnas">                                
                                <img style="opacity: {{capa.opacidad}}" src="{{getImgUrl(capa.url, j.valor, i.valor + 1, j.valor + 1, i.valor )}}" width="{{sizeX}}" height="{{sizeY}}"/>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>


    </body>
</html>
