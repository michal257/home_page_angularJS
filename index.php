<!DOCTYPE html>
<html lang="pl">

<head>

	<meta charset="utf-8"/>
	
	<!--<link href="css/style.css" rel="stylesheet"/>-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="css/styles.css" rel="stylesheet"/>
	<link href='https://fonts.googleapis.com/css?family=Josefin+Sans:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
        
        <!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]--> 

</head>

<body ng-app="app">
	
    <div ng-controller="index-page">
        <!--<div class="background" style="background-image: url('image/{{setWallpaper.set}}');"></div>	-->
        <div class="background"></div>	
    </div>
    <div class="backgroundFilter"></div>
    <div ng-view></div>
        
       
	
<!--=============== JAVASCRIPT =======================-->	

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular-route.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular-cookies.min.js"></script>

<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>

<script src="js/my_function.js"></script>	
<script src="js/aplication.js"></script>	
<script src="js/home.js"></script>	
<script src="js/login_page.js"></script>	
<script src="js/register_page.js"></script>	
<script src="js/activate_page.js"></script>
<script src="js/catalog_page.js"></script>

</body>

</html>