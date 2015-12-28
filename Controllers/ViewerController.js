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

            $scope.capaHospUrl = "";
            $scope.capaHospTxt = "Cargar Hospitales";
            $scope.capaHosp = false;

            $scope.capaRiosUrl = "";
            $scope.capaRiosTxt = "Cargar Rios";
            $scope.capaRios = false;

            $scope.capaCaminosUrl = "";
            $scope.capaCamTxt = "Cargar Caminos";
            $scope.capaCam = false;

            $scope.urlHospitales = "Queries/Hospitales/imagenHospitales.php?x=" + $scope.sizeX + "&y=" + $scope.sizeY;
            $scope.urlRios = "Queries/Rios/imagenRios.php?x=" + $scope.sizeX + "&y=" + $scope.sizeY;
            $scope.urlCaminos = "Queries/Caminos/imagenCaminos.php?x=" + $scope.sizeX + "&y=" + $scope.sizeY;


            //arreglo que contiene capas, representadas por objetos
            $scope.capas = [
                
                {
                    nombre: "Rios", //nombre de la capa
                    prioridad: 0, // prioridad de la capa
                    visible: false, // visible u opculto
                    url: "" // dirección para crear la imagen
                },
                {
                    nombre: "Hospitales",
                    prioridad: 1,
                    visible: false,
                    url: ""
                },
                {
                    nombre: "Caminos",
                    prioridad: 2,
                    visible: false,
                    url: ""
                }
            ];

            $scope.cambiarTam = function () {

                if ($scope.sizeX === 640) {
                    $scope.sizeX = 1024;
                    $scope.sizeY = 840;
                    if ($scope.capaHosp === true) {
                        $scope.capaHospUrl = "Queries/Hospitales/imagenHospitales.php?x=" + $scope.sizeX + "&y=" + $scope.sizeY;
                    }
                    if ($scope.capaCam === true) {
                        $scope.capaCaminosUrl = "Queries/Caminos/imagenCaminos.php?x=" + $scope.sizeX + "&y=" + $scope.sizeY;
                    }
                    if ($scope.capaRios === true) {
                        $scope.capaRiosUrl = "Queries/Rios/imagenRios.php?x=" + $scope.sizeX + "&y=" + $scope.sizeY;
                    }
                }
                else {
                    $scope.sizeX = 640;
                    $scope.sizeY = 480;
                    if ($scope.capaHosp === true) {
                        $scope.capaHospUrl = "Queries/Hospitales/imagenHospitales.php?x=" + $scope.sizeX + "&y=" + $scope.sizeY;
                    }
                    if ($scope.capaCam === true) {
                        $scope.capaCaminosUrl = "Queries/Caminos/imagenCaminos.php?x=" + $scope.sizeX + "&y=" + $scope.sizeY;
                    }
                    if ($scope.capaRios === true) {
                        $scope.capaRiosUrl = "Queries/Rios/imagenRios.php?x=" + $scope.sizeX + "&y=" + $scope.sizeY;
                    }
                }
            }
            

            /*
             * Funcion para controlar la opcion de ocultar y mostrar una determinada capa
             * @param {type} id entero que además de ser id, funciona para representar la posicion
             * del objeto dentro del arreglo
             * @returns {undefined}
             */
            $scope.controlarVisualizacion = function (id) {

                if ($scope.capas[id].visible === false) {
                    $scope.capas[id].visible = true;
                    
                    //si es la primera vez que se muestran
                    if ($scope.capas[id].url === "") {
                        
                        //mostrar la capa de hospitales si es el caso
                        if ($scope.capas[id].nombre === "Hospitales") {
                            $scope.capas[id].url = $scope.urlHospitales;
                         
                        }
                        
                        //mostrar la capa de caminos si es el caso
                        else if ($scope.capas[id].nombre === "Caminos") {
                            $scope.capas[id].url = $scope.urlCaminos;
                         
                        }
                        //mostrar la capa de Rios si es el caso
                        else if ($scope.capas[id].nombre === "Rios") {
                            $scope.capas[id].url = $scope.urlRios;                         
                        }
                    }
                }
                
                //si se solicita un cambio en el estado de visualizacion y se sabe que
                // esta mostrandose entonces se oculta
                else {
                    $scope.capas[id].visible = false;
                }

            };
        });