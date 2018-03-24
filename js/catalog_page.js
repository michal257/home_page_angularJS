'use strict';

controllers.controller( 'catalog-page' , [ '$scope' , '$http', '$routeParams', function( $scope, $http, $routeParams ){
        
    //------------ Pobieranie skrotow z bazy -------------
    $http.post('api/get_abbreviation.php', {

        idCatalog : $routeParams.id

    }).success(function(data){
        $scope.abbreviations = data;
    }).error(function(){
    });
    
    //------------------Control Windows------------------
    
    $('#abbreviationInCatalog-window-open').click(function(){
        $('.abbreviation-add').css("display" , "flex");
    });

    $('.closeAddAbbreviation').click(function(){
        $('.abbreviation-add').hide();
    });
    
    $('#close-delete-window-btn').click(function(){
        $('.delete-window').css("display" , "none");
    });
        
    $scope.abbreviation = [];
    $scope.abbreviation.name = "Nazwa skrótu";
    $scope.abbreviation.color = "grey";
    $scope.abbreviation.icon = ".";

    $('.blue').click(function(){
        changeColor("blue");
        $scope.abbreviation.color = "blue";
    });
    $('.red').click(function(){
        changeColor("red");
        $scope.abbreviation.color = "red";
    });
    $('.green').click(function(){
        changeColor("green");
        $scope.abbreviation.color = "green";
    });
    $('.black').click(function(){
        changeColor("black");
        $scope.abbreviation.color = "black";
    });
    $('.grey').click(function(){
        changeColor("grey");
        $scope.abbreviation.color = "grey";
    });  
    
    // ------------ Add new abbreviation ----------------
        
    $scope.addAbbreviation = function( abbreviation ){
                
        $http.post('api/add_abbreviation.php' , {

            abbreviation_catalogId : $routeParams.id,
            abbreviation_name : abbreviation.name,
            abbreviation_url : abbreviation.url,
            abbreviation_icon : abbreviation.icon,
            abbreviation_color : abbreviation.color

        }).success( function(data){
            $scope.add = data;
            if ($scope.add.add ===1)
            {
                $('.abbreviations_one').append('<div class="col-xs-4 col-sm-3 col-md-1" ng-repeat="abbreviation in abbreviations"><a href="http://' + abbreviation.url + '"><div class="abbreviation text-center" style="background-image: url(\'image/' + abbreviation.color + '.png\');">' + abbreviation.icon + '</div><div class="abbreviation-text text-center">' + abbreviation.name + '</div></a></div>');
                $('.abbreviation-add').hide();
            }
            else if ($scope.add.add === 0)
            {
               $scope.add.error = true; 
            }
        }).error( function(){
            console.log("Wystapil problem z zapisem do bazydanych !");
        });
    };
    $scope.urlAddress = /https?:\/\/(?:www\.|(?!www))[^\s\.]+\.[^\s]{2,}|www\.[^\s]+\.[^\s]{2,}/; 
    
    $('#delete-abbreviation-show').on("click" , deleteAbbreviationShow);
    $('#edit-abbreviation-show').on("click" , editAbbreviationShow);
    
    // ------------ Delete abbreviations and catalogs----------------
    
    var number;
    $scope.windowYesNo = [];  
    $scope.deletingShow = function(id, name)
    {
        $scope.windowYesNo.name = name;
        $('.delete-window').css("display" , "flex");
        number = id;
    };
    
    $scope.deleting = function()
    {
      $('.delete-window').css("display" , "none");
      $('#abbreviation'+ number).hide(1000);
      $('.delete').css("display", "none");
      $('.link-abbreviation2').removeClass("link-abbreviation");
    };
}]);