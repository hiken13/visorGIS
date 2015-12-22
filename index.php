<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html>
    <head ng-app="visorGIS">
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.7/angular.min.js"></script>
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

                <div class="container" id="Panel" style="background-color: gray; height:400px; width:200px;">
                </div>
            </div>          

            <div class="container" id="Panel" style="background-color: gray; height:480px; width:640px">

            </div>
            <div id="panelBotones">
                <div class="btn-group" style=" top: 5%">            
                    <a href="#" class="btn btn-default btn-sm glyphicon glyphicon-plus"></a>
                    <a href="#" class="btn btn-default btn-sm glyphicon glyphicon-minus"></a>               
                    <a href="#" class="btn btn-default btn-sm">Cambiar tamaño</a>  
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
