'use strict';

var app = angular.module( 'app' , [ 'ngRoute' , 'controllers' ] );

app.config([ '$routeProvider' , function( $routeProvider ) {
	
	$routeProvider.when( '/login-page' , {
		controller :'login-page',
		templateUrl : 'parts/login-page.php'
	});
	
	$routeProvider.when( '/home' , {
		controller :'home',
		templateUrl : 'parts/home.php'
	});
        
        $routeProvider.when( '/register' , {
		controller :'register',
		templateUrl : 'parts/register.php'
	});
        
        $routeProvider.when( '/active-page' , {
		controller :'active-page',
		templateUrl : 'parts/active-page.php'
	});
        
        $routeProvider.when( '/catalog-page/:id' , {
		controller :'catalog-page',
		templateUrl : 'parts/catalog-page.php'
	});
	
	$routeProvider.otherwise({
		redirectTo: '/login-page'
	});
	
}]);


