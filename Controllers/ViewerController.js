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
                },
                {
                    nombre: "Escuelas",
                    prioridad: 3,
                    visible: false,
                    url: ""
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
                            console.log("Hola");
                            if ($scope.capas[i].nombre === "Hospitales") {
                                $scope.capas[i].url = "Queries/Hospitales/imagenHospitales.php?x=" + $scope.sizeX + "&y=" + $scope.sizeY;
                            }

                            //mostrar la capa de caminos si es el caso
                            else if ($scope.capas[i].nombre === "Caminos") {
                                $scope.capas[i].url = "Queries/Caminos/imagenCaminos.php?x=" + $scope.sizeX + "&y=" + $scope.sizeY;

                            }
                            //mostrar la capa de Rios si es el caso
                            else if ($scope.capas[i].nombre === "Rios") {
                                $scope.capas[i].url = "Queries/Rios/imagenRios.php?x=" + $scope.sizeX + "&y=" + $scope.sizeY;
                            }
                            //mostrar la capa de Escuelas si es el caso
                            else if ($scope.capas[i].nombre === "Escuelas") {
                                $scope.capas[i].url = "Queries/Escuelas/imagenEscuelas.php?x=" + $scope.sizeX + "&y=" + $scope.sizeY;
                            }
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
                            console.log("Hola");
                            if ($scope.capas[i].nombre === "Hospitales") {
                                $scope.capas[i].url = "Queries/Hospitales/imagenHospitales.php?x=" + $scope.sizeX + "&y=" + $scope.sizeY;
                            }

                            //mostrar la capa de caminos si es el caso
                            else if ($scope.capas[i].nombre === "Caminos") {
                                $scope.capas[i].url = "Queries/Caminos/imagenCaminos.php?x=" + $scope.sizeX + "&y=" + $scope.sizeY;

                            }
                            //mostrar la capa de Rios si es el caso
                            else if ($scope.capas[i].nombre === "Rios") {
                                $scope.capas[i].url = "Queries/Rios/imagenRios.php?x=" + $scope.sizeX + "&y=" + $scope.sizeY;
                            }
                            
                            //mostrar la capa de Escuelas si es el caso
                            else if ($scope.capas[i].nombre === "Escuelas") {
                                $scope.capas[i].url = "Queries/Escuelas/imagenEscuelas.php?x=" + $scope.sizeX + "&y=" + $scope.sizeY;
                            }
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

                        //mostrar la capa de hospitales si es el caso
                        if ($scope.capas[id].nombre === "Hospitales") {
                            $scope.capas[id].url = "Queries/Hospitales/imagenHospitales.php?x=" + $scope.sizeX + "&y=" + $scope.sizeY;
                        }

                        //mostrar la capa de caminos si es el caso
                        else if ($scope.capas[id].nombre === "Caminos") {
                            $scope.capas[id].url = "Queries/Caminos/imagenCaminos.php?x=" + $scope.sizeX + "&y=" + $scope.sizeY;
                        }
                        //mostrar la capa de Rios si es el caso
                        else if ($scope.capas[id].nombre === "Rios") {
                            $scope.capas[id].url = "Queries/Rios/imagenRios.php?x=" + $scope.sizeX + "&y=" + $scope.sizeY;
                        }
                        //mostrar la capa de Escuelas si es el caso
                        else if ($scope.capas[id].nombre === "Escuelas") {
                            $scope.capas[id].url = "Queries/Escuelas/imagenEscuelas.php?x=" + $scope.sizeX + "&y=" + $scope.sizeY;
                        }
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


        });
