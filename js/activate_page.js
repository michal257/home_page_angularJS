'use strict';

controllers.controller( 'active-page' , [ '$scope' , '$http', function( $scope, $http ){
        
    $scope.activation = function ( active ){
        $http.post('api/active.php' ,{
            activeKey : active.key
        }).success( function(data){
            $scope.activate = data;
            if($scope.activate.active === 1)
                window.location.replace("#/home");
            else if ($scope.activate.active === 0)
            {   
                $scope.activate.error = true;
            }
        }).error(function(){
            console.log("Błąd!");
        });
    };
}]);

controllers.controller( 'index-page' , [ '$scope' , '$rootScope', function( $scope, $rootScope ){
    
    
    if ($rootScope.wallpaperSS == null)
    {
        $rootScope.wallpaperSS = "3";
    }

    $scope.$watch('wallpaperSS', function(){
        $('.background').css("background-image", "url('wallpapers/4k/" + $rootScope.wallpaperSS + ".jpg')");
    });
}]);