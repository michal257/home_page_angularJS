'use strict';

controllers.controller( 'login-page' , [ '$scope' ,'$http' , '$rootScope', '$cookies', function( $scope , $http, $rootScope, $cookies ){
    
    $http.post('api/logout.php');
    
    $rootScope.wallpaperSS = $cookies.get('path');
    
    $scope.login = function(log){
        $http.post('api/login.php',{
          
            login : log.login,
            pass : log.pass
          
        }).success( function(data){
            $rootScope.user = data;
            console.log(data);
            if ($rootScope.user.loged === 1)
                window.location.replace("#/home");
            else if ($rootScope.user.loged === 0)
                $scope.user.error = true;
            else if ($rootScope.user.loged === 2)
                window.location.replace("#/active-page");
              

      }).error( function(){
          console.log("Wystąpił problem w połączeniu z baza!");
      });
    };
        
}]);