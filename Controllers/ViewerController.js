/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

angular.module('visorGIS', [])
        .controller('ControllerViewerGIS', function ($scope, $http)
        {
            console.log("Hola");
            $scope.capaHospTxt = "Cargar Capa de Hospitales";
            $scope.capaHosp = false;
            
            /**
             * 
             * @returns {undefined}
             */
            $scope.cargarHospitales = function(){
                console.log("Hola");
                if($scope.capaHosp === false){
                    $scope.capaHospTxt = "Ocultar Capa de Hospitales";
                    $scope.capaHosp = true;
                }
                else{
                    $scope.capaHospTxt = "Cargar Capa de Hospitales";
                    $scope.capaHosp = false;
                }
            };
           
        });