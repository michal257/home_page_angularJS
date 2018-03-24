'use strict';

controllers.controller( 'register' , [ '$scope' , '$http', function( $scope, $http ){
	
    $scope.register = [];
    $scope.register.name = "";
    $scope.register.check = false;
    
    $scope.registering = function( register ){
        $http.post('api/registration.php' ,{
            
            registerName : register.name,
            registerEmail : register.email,
            registerPass : register.pass,
            registerRepeatPass : register.repeatPass,
            registerCheck : register.check
            
        }).success( function(data){
            $scope.value = data;
            
            if ($scope.value.active === 1)
                window.location.replace("#/active-page");
        }).error( function(){
            console.log("Wystapil problem z zapisem do bazydanych !");
        });
    };
}]);