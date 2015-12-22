/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

angular.module('visorGIS', [])
        .controller('ControllerViewerGIS', function ($scope, $http)
        {
            console.log("Hola");


            $http.get("imagen.php?x=640&y=480")
                    .success(function (data) {
                        $scope.cursos = data;
                        console.log(data);
                    })
                    .error(function (err) {
                        console.log("Error cargando el div");
                    });

        });