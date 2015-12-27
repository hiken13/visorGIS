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
                <a href="#" class="btn btn-default btn-sm" ng-click="cargarRios()">{{capaRiosTxt}}</a>
                <a href="#" class="btn btn-default btn-sm" ng-click="cargarHospitales()">{{capaHospTxt}}</a>
                <a href="#" class="btn btn-default btn-sm" ng-click="cargarCaminos()">{{capaCamTxt}}</a>
            </div>
        </div>          

        <div style="background-color: gray; height:{{sizeY}}px; width:{{sizeX}}px; position: relative; left: 350px; top: 20px ">
            <table style="position: absolute">
                <tr>
                    <td>
                        <img ng-show="capaCam" src="{{capaCaminosUrl}}" width="{{sizeX}}" height="{{sizeY}}" />               
                    </td>
                </tr>                   
            </table>            

            <table style="position: absolute">
                <tr>
                    <td>
                        <img  ng-show="capaRios" src="{{capaRiosUrl}}" width="{{sizeX}}" height="{{sizeY}}" />               
                    </td>
                </tr>                   
            </table>

            <table style="position: absolute">
                <tr>
                    <td>
                        <img ng-show="capaHosp" src="{{capaHospUrl}}" width="{{sizeX}}" height="{{sizeY}}" />               
                    </td>
                </tr>                   
            </table>


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
