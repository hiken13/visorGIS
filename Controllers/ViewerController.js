/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

angular.module('visorGIS', [])
        .controller('ControllerViewerGIS', function ($scope, $http)
        {
            $scope.sizeX = 640; //tamaño inicial de x
            $scope.sizeY = 480; //tamaño inicial de y
            
            console.log("Hola");
            $scope.capaHospTxt = "Cargar Hospitales";
            $scope.capaHosp = false;
            $scope.capaRios = true;
            
            
            $scope.cambiarTam = function(){
                if($scope.sizeX === 640){
                    $scope.sizeX = 1024;
                    $scope.sizeY = 840;
                }
                else{
                    $scope.sizeX = 640;
                    $scope.sizeY = 480;
                }
            }
            /**
             * funcion para cargar u ocultar la capa de hospitales
             * @returns {undefined}
             */
            $scope.cargarHospitales = function(){
                console.log("Hola");
                if($scope.capaHosp === false){
                    $scope.capaHospTxt = "Ocultar Hospitales";
                    $scope.capaHosp = true;
                }
                else{
                    $scope.capaHospTxt = "Cargar Hospitales";
                    $scope.capaHosp = false;
                }
            };
           
        });