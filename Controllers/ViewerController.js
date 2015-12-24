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
            
            $scope.capaHospUrl="";
            $scope.capaHospTxt = "Cargar Hospitales";
            $scope.capaHosp = false;
            
            $scope.capaRiosUrl="";
            $scope.capaRiosTxt = "Cargar Rios";
            $scope.capaRios = false;
            
            $scope.capaCaminosUrl="";
            $scope.capaCamTxt = "Cargar Caminos";
            $scope.capaCam = false;
            
            
            $scope.cambiarTam = function(){
                
                if($scope.sizeX === 640){
                    $scope.sizeX = 1024;
                    $scope.sizeY = 840;
                    if($scope.capaHosp===true){
                        $scope.capaHospUrl="Queries/Hospitales/imagenHospitales.php?x="+$scope.sizeX+"&y="+$scope.sizeY;
                    }
                    if($scope.capaCam===true){
                        $scope.capaCaminosUrl="Queries/Caminos/imagenCaminos.php?x="+$scope.sizeX+"&y="+$scope.sizeY;           
                    }
                    if($scope.capaRios===true){
                        $scope.capaRiosUrl="Queries/Rios/imagenRios.php?x="+$scope.sizeX+"&y="+$scope.sizeY;
                    }
                }
                else{
                    $scope.sizeX = 640;
                    $scope.sizeY = 480;
                    if($scope.capaHosp===true){
                        $scope.capaHospUrl="Queries/Hospitales/imagenHospitales.php?x="+$scope.sizeX+"&y="+$scope.sizeY;
                    }
                    if($scope.capaCam===true){
                        $scope.capaCaminosUrl="Queries/Caminos/imagenCaminos.php?x="+$scope.sizeX+"&y="+$scope.sizeY;           
                    }
                    if($scope.capaRios===true){
                        $scope.capaRiosUrl="Queries/Rios/imagenRios.php?x="+$scope.sizeX+"&y="+$scope.sizeY;
                    }
                }
            }
            /**
             * funcion para cargar u ocultar la capa de hospitales
             * @returns {undefined}
             */
            $scope.cargarHospitales = function(){
               $scope.capaHospUrl="Queries/Hospitales/imagenHospitales.php?x="+$scope.sizeX+"&y="+$scope.sizeY;
                if($scope.capaHosp === false){
                    $scope.capaHospTxt = "Ocultar Hospitales";
                    $scope.capaHosp = true;
                }
                else{
                    $scope.capaHospTxt = "Cargar Hospitales";
                    $scope.capaHosp = false;
                }
            };
            
            $scope.cargarRios = function(){
                $scope.capaRiosUrl="Queries/Rios/imagenRios.php?x="+$scope.sizeX+"&y="+$scope.sizeY;
                if($scope.capaRios === false){
                    $scope.capaRiosTxt = "Ocultar Rios";
                    $scope.capaRios = true;
                }
                else{
                    $scope.capaRiosTxt = "Cargar Rios";
                    $scope.capaRios = false;
                }
            };
            
            $scope.cargarCaminos = function(){
              $scope.capaCaminosUrl="Queries/Caminos/imagenCaminos.php?x="+$scope.sizeX+"&y="+$scope.sizeY;           
                if($scope.capaCam === false){
                    $scope.capaCamTxt = "Ocultar Caminos";
                    $scope.capaCam = true;
                }
                else{
                    $scope.capaCamTxt = "Cargar Caminos";
                    $scope.capaCam = false;
                }
            };
           
        });