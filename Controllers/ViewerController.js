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
            $scope.zi = 0.0;
            $scope.opacidad = 1;



            //arreglo que contiene capas, representadas por objetos
            $scope.capas = [
                {
                    nombre: "Rios", //nombre de la capa
                    prioridad: 0, // prioridad de la capa
                    visible: false, // visible u opculto
                    url: "", // dirección para crear la imagen
                    actualizar: false,
                    opacidad: 1
                },
                {
                    nombre: "Hospitales",
                    prioridad: 1,
                    visible: false,
                    url: "",
                    actualizar: false,
                    opacidad: 1
                },
                {
                    nombre: "Caminos",
                    prioridad: 2,
                    visible: false,
                    url: "",
                    actualizar: false,
                    opacidad: 1

                },
                {
                    nombre: "Escuelas",
                    prioridad: 3,
                    visible: false,
                    url: "",
                    actualizar: false,
                    opacidad: 1
                },
                {
                    nombre: "Distritos",
                    prioridad: 4,
                    visible: false,
                    url: "",
                    actualizar: false,
                    opacidad: 1
                }
            ];

            $scope.cambiarTam = function () {

                if ($scope.sizeX === 640) {
                    $scope.sizeX = 1024;
                    $scope.sizeY = 840;

                    for (i = 0; i < $scope.capas.length; i++) {
                        //si la capa actual tiene como estado visible, entonces actualizar
                        //el tamaño de la imagen de acuerdo a las dimesiones
                        if ($scope.capas[i].visible === true) {
                            $scope.capas[i].url = "Queries/" + $scope.capas[i].nombre + "/imagen" + $scope.capas[i].nombre + ".php?x=" + $scope.sizeX + "&y=" + $scope.sizeY + "&zi=" + $scope.zi;
                        }
                    }
                }
                else {
                    $scope.sizeX = 640;
                    $scope.sizeY = 480;
                    for (i = 0; i < $scope.capas.length; i++) {
                        //si la capa actual tiene como estado visible, entonces actualizar
                        //el tamaño de la imagen de acuerdo a las dimesiones
                        if ($scope.capas[i].visible === true) {
                            $scope.capas[i].url = "Queries/" + $scope.capas[i].nombre + "/imagen" + $scope.capas[i].nombre + ".php?x=" + $scope.sizeX + "&y=" + $scope.sizeY + "&zi=" + $scope.zi;
                        }
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
                        //mostrar la capa requerida
                        $scope.capas[id].url = "Queries/" + $scope.capas[id].nombre + "/imagen" + $scope.capas[id].nombre + ".php?x=" + $scope.sizeX + "&y=" + $scope.sizeY + "&zi=" + $scope.zi;
                        console.log($scope.capas[id].url);
                    }
                    else if ($scope.capas[id].actualizar === true) {
                        $scope.capas[id].actualizar = false;
                        $scope.capas[id].url = "Queries/" + $scope.capas[id].nombre + "/imagen" + $scope.capas[id].nombre + ".php?x=" + $scope.sizeX + "&y=" + $scope.sizeY + "&zi=" + $scope.zi;
                    }
                }

                //si se solicita un cambio en el estado de visualizacion y se sabe que
                // esta mostrandose entonces se oculta
                else {
                    $scope.capas[id].visible = false;
                }
            };
            $scope.subir = function (id) {
                if (id > 0) {
                    $scope.capas[id].prioridad = id - 1;
                    $scope.capas[id - 1].prioridad = id;

                    var temp = $scope.capas[id - 1];
                    $scope.capas[id - 1] = $scope.capas[id];
                    $scope.capas[id] = temp;
                }
            };

            $scope.bajar = function (id) {
                if (id < $scope.capas.length - 1) {
                    $scope.capas[id].prioridad = id + 1;
                    $scope.capas[id + 1].prioridad = id;

                    var temp = $scope.capas[id + 1];
                    $scope.capas[id + 1] = $scope.capas[id];
                    $scope.capas[id] = temp;
                }
            };

            /**
             * Funcion para raalizar zoom, modifica dependiendo de su parametro el varlor
             * del zoom del visor y 
             * @param {type} ind indicador para saber si la operacion es de acercar,, alejar o resetear al zoom default
             * @returns {undefined}
             */
            $scope.zoomIn = function (ind) {
                if ($scope.zi < 0.9 && ind === 1) {
                    $scope.zi = $scope.zi + 0.1;
                } else if ($scope.zi < 0.9 && ind === 0 && $scope.zi > 0) {
                    $scope.zi = $scope.zi - 0.1;
                }
                else {
                    $scope.zi = 0;
                }
                for (i = 0; i < $scope.capas.length; i++) {
                    if ($scope.capas[i].visible === true) {
                        $scope.capas[i].url = "Queries/" + $scope.capas[i].nombre + "/imagen" + $scope.capas[i].nombre + ".php?x=" + $scope.sizeX + "&y=" + $scope.sizeY + "&zi=" + $scope.zi;
                    }
                    else {
                        if ($scope.capas[i].url !== "") {
                            $scope.capas[i].actualizar = true;
                        }
                    }
                }
            };
            $scope.aumentarTransparencia = function (id, ind) {
                if (ind === 1) {

                    $scope.capas[id].opacidad -= 0.1;
                }
                else{
                    $scope.capas[id].opacidad += 0.1;
                }
            };
        });
