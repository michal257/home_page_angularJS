'use strict';
var controllers = angular.module( 'controllers' , ['ngRoute', 'ngCookies'] );

//============================================    HOME    ======================================//

controllers.controller( 'home' , [ '$scope' , '$http' , '$rootScope', '$compile', '$cookies', function( $scope , $http, $rootScope, $compile, $cookies ){
        
    $scope.windowYesNo = [];
    
    //-----------Get abbreviation from database when page is loading--------
    $http.post('api/get_abbreviation.php' , {   
        idCatalog : 1
    })
    .success( function( data ){
        $scope.abbreviations = data;
        if ($scope.abbreviations.error === true)
        {
            window.location.replace("#/login-page");
            return;
        }
    })
    .error( function(){
        console.log("Wystapil problem z polonczeniem do bazy !");
    });

    //---------Get catalogs from database when page is loading----------
    $http.post('api/get_catalogs.php' , {})
    .success( function( data )
    {
        $scope.catalogs = data;
        if ($scope.abbreviations.error === true)
        {
            window.location.replace("#/login-page");
            return;
        }
    })
    .error( function()
    {
        console.log("Wystapil problem z polonczeniem do bazy !");
    });
 
   //---------Delete abbreviation and catalogs ---------------- 
    var number;
    $scope.deletingShow = function(id, type, name)
    {
        if (type === 1)
            $scope.windowYesNo.type = "skrót";
        else
            $scope.windowYesNo.type = "katalog";
        
        $scope.windowYesNo.name = name;
        
        $('.delete-window').css("display" , "flex");
        number = id;
    };
    
    //------------------ Set Wallpaper --------------------------  
    
    $http.post('api/setWallpaper.php')
        .success( function(data1){
            $rootScope.wallpaperSS = data1.path;
            
            var expireDate = new Date();
            expireDate.setDate(expireDate.getDate() + 1);

            
            $cookies.put('path', data1.path, {'expires' : expireDate});
        }).error( function(){
            console.log("Wystąpił problem w połączeniu z baza!");
    });
    
    $scope.deleting = function(type)
    {
      $('.delete-window').css("display" , "none");
      
      if (type == 'skrót')
      {
          $('#abbreviation'+ number).hide(1000);
      }
      else if (type == 'katalog')
      {
          $('#catalog'+ number).hide(1000);
      }
        
      $('.delete').css("display", "none");
      $('.link-abbreviation2').removeClass("link-abbreviation");
    };
    
    //---------------Edit Abbreviation------------------------
    $scope.abbreviationEdit = [];
    $scope.editingShow = function(id, color, name, url, icon)
    {
        $scope.abbreviationEdit = [];
        $scope.abbreviationEdit.id = id;
        $scope.abbreviationEdit.color = color;
        $scope.abbreviationEdit.name = name;
        $scope.abbreviationEdit.url = url;
        $scope.abbreviationEdit.icon = icon;
        $('.abbreviation-edit').css("display", "flex");
    };
    
    // -------- Save edited abbreviation--------------------  
    $scope.editSave = function(abbreviationEdit)
    {

        if((abbreviationEdit.url == null) || (abbreviationEdit.name == null) || (abbreviationEdit.icon == null))
            return;

        abbreviationEdit.url = checkUrl(abbreviationEdit.url);

        $http.post('api/edit_abbreviation.php',{
            editId : abbreviationEdit.id,
            editColor : abbreviationEdit.color,
            editIcon : abbreviationEdit.icon,
            editName : abbreviationEdit.name,
            editUrl : abbreviationEdit.url
            
        })
        .success(function(){
            
            $('.edit').css("display", "none"); //delete edit icon
            $('.link-abbreviation2').removeClass("link-abbreviation");  //delete opacity icon
            $('#abbreviation' + abbreviationEdit.id + ' .abbreviation')
            .css("background-image", "url('image/" + abbreviationEdit.color + ".png")
            .html(abbreviationEdit.icon)
            .addClass("rotate");
            $('#abbreviation' + abbreviationEdit.id + ' .abbreviation-text').html(abbreviationEdit.name);
            $('#abbreviation' + abbreviationEdit.id + ' a').attr("href", abbreviationEdit.url);
            $('.abbreviation-edit').hide();
        })
        .error(function(){
            console.log("Wystapil problem w polonczeniu z baza !");
        });
        
    };
    
    //------------------Edit Catalogs------------------------
    $scope.catalogEdit = [];
    $scope.editingCatalogShow = function(id, color, name, icon)
    {
        
        $scope.catalogEdit.id = id;
        $scope.catalogEdit.color = color;
        $scope.catalogEdit.name = name;
        $scope.catalogEdit.icon = icon;
        $('.catalog-edit').css("display", "flex");
    };
    
    //--------------Save Editing Catalogs------------------------
    
    $scope.editCatalogSave = function(catalogEdit)
    {
        if((catalogEdit.name == null) || (catalogEdit.icon == null))
            return;
        
        $http.post('api/edit_catalog.php',
        {
            editId : catalogEdit.id,
            editColor : catalogEdit.color,
            editIcon : catalogEdit.icon,
            editName : catalogEdit.name
        })
        .success(function()
        {
            $('.edit').css("display", "none"); //delete edit icon
            $('.link-abbreviation2').removeClass("link-abbreviation");  //delete opacity icon
            $('#catalog' + catalogEdit.id + ' .abbreviation')
            .css("background-image", "url('image/" + catalogEdit.color + ".svg")
            .html(catalogEdit.icon)
            .addClass("rotate");
            $('#catalog' + catalogEdit.id + ' .abbreviation-text').html(catalogEdit.name);
            $('.catalog-edit').hide();
        })
        .error(function()
        {
            console.log("Wystapil problem w polonczeniu z baza !");
        });
    };
    
    
    // --------------add new abbreviation--------------------
    $scope.abbreviation = [];
    $scope.abbreviation.name = "Nazwa skrótu";
    $scope.abbreviation.color = "grey";
    $scope.abbreviation.icon = ".";
    
    $scope.addAbbreviation = function( abbreviation ){
        
        if((abbreviation.url == null) || (abbreviation.name == null) || (abbreviation.icon == null))
            return;

        abbreviation.url = checkUrl(abbreviation.url);
        
        console.log("wskoczylo");
        
        $http.post('api/add_abbreviation.php' , {
            
            abbreviation_catalogId : 1,
            abbreviation_name : abbreviation.name,
            abbreviation_url : abbreviation.url,
            abbreviation_icon : abbreviation.icon,
            abbreviation_color : abbreviation.color
        }).success( function(data){
            $scope.add = data;

            if ($scope.add.add ===1)
            {
                $('.abbreviations_one').append('<div class="col-xs-4 col-sm-3 col-md-1" ng-repeat="abbreviation in abbreviations"><a href="' + abbreviation.url + '" target="_blank" class="link-abbreviation2"><div class="abbreviation text-center" style="background-image: url(\'image/' + abbreviation.color + '.png\');">' + abbreviation.icon + '</div><div class="abbreviation-text text-center">' + abbreviation.name + '</div></a><a class="delete glyphicon glyphicon-trash" ng-click="deletingShow(' + $scope.add.addId + ', 1, ' + abbreviation.name + ')"><a class="edit glyphicon glyphicon-pencil" ng-click="editingShow(' + $scope.add.addId + ', ' + abbreviation.color + ', ' + abbreviation.name + ', ' + abbreviation.url + ', ' + abbreviation.icon + ')"></a></a></div>');
                $('.abbreviation-add').hide();
            }
            else if ($scope.add.add === 0)
            {
               $scope.add.error1 = true; 
            }
        }).error( function(){
            console.log("Wystapil problem z zapisem do bazydanych !");
        });
    };
    
    // --------------add new catalog----------------------
    
    $scope.catalog = [];
    $scope.catalog.name = "Nazwa skrótu";
    $scope.catalog.color = "grey";
    $scope.catalog.icon = ".";
    
    $scope.addCatalog = function( catalog ){
        
        if((catalog.name == null) || (catalog.icon == null))
            return;
        
        $http.post('api/add_catalog.php' , {
            user_id : 1,
            catalog_name : catalog.name,
            catalog_icon : catalog.icon,
            catalog_color : catalog.color

        }).success( function(data){
            $scope.add = data;
            if ($scope.add.add === 1)
            {
                $('.catalogs_one').append('<div class="col-xs-4 col-sm-3 col-md-1" ng-repeat="catalog in catalogs"><a href="http://wp.pl"><div class="abbreviation text-center" style="background-image: url(\'image/' + catalog.color + '.svg\');">' + catalog.icon + '</div><div class="abbreviation-text text-center">' + catalog.name + '</div></a></div>');
                $('.catalog-add').hide();
            }
            else if ($scope.add.add === 0)
            {
              $scope.add.error = true;  
            }
        }).error( function(){
            console.log("Wystapil problem z zapisem do bazydanych !");
        });
    };
    
    //-------------get wallpaper---------------
    
    $http.post('api/get_wallpapers.php')
    .success(function(data){
        $scope.wallpapers = data;
    })
    .error(function(){
        console.log("Wystąpił problem w polaczeniu z baza !");
    });
        
    $('#open-wallpapers-window').click(function(){
        $('.setings-window').css("display" , "none");
        $('.window-wallpapers-all').css("display" , "flex");
    });
    
    //-------------select wallpaper---------------
    
    $scope.selectWallpaper = function( wallpaper ){
      $scope.wallpaperOne = [];
      $scope.wallpaperOne.id = wallpaper.id;
      $scope.wallpaperOne.path = wallpaper.wall;
      $('.window-wallpaperOne').css("display", "flex");
      $('.window-wallpapers-all').css("display", "none");
    };
    
    //-------------change wallpaper---------------
    
    $scope.setWallpaper = function(wallpaper){
      $http.post('api/change_wallpaper.php', {
          idWallpaper : wallpaper.id
      }).success(function(data){
          $scope.changeWallpaper = data;
          if ($scope.changeWallpaper.change === 1)
          {
                $('.window-wallpaperOne').css("display" , "none");
                $rootScope.wallpaperSS = wallpaper.path;
          }
          else
              console.log("Wystąpił problem ze zmianą tła !");
      }).error(function(){
          console.log("Wystąpił problem ze zmianą tła !");
      });
    };
    
    //----------control  windows---------------
    
    
    $('#close-window-wallpaperOne').click(function(){
       $('.window-wallpaperOne').css("display" , "none");
       $('.window-wallpapers-all').css("display" , "flex");
    });
    
    $('#close-window-wallpaper-all').click(function(){
        $('.window-wallpapers-all').css("display" , "none");
    });
    
    $('#close-window-setings').click(function(){
        $('.setings-window').css("display" , "none");
    });
        
    $('#setings-window-show').click(function(){
        $('.setings-window').css("display" , "flex");
    });
        
    $('#close-delete-window-btn').click(function(){
        $('.delete-window').css("display" , "none");
    });
        
    $('#abbreviation-window-open').click(function(){
        $('.select-window').css("display" , "flex");
    });

    $('#abbreviation-add-open-btn').click(function(){
        $('.select-window').css("display" , "none");         
        $('.abbreviation-add').css("display" , "flex"); 
    });

    $('#catalog-add-open-btn').click(function(){
        $('.select-window').css("display" , "none");         
        $('.catalog-add').css("display" , "flex"); 
    });

    $('#close-dialog-window-btn').click(function(){
        $('.select-window').hide();
    });

    $('.closeAddAbbreviation').click(function(){
        $('.abbreviation-add').hide();
        $('.catalog-add').hide();
        $('.abbreviation-edit').hide();
        $('.catalog-edit').hide();
    });
    
    $('#notebook-window-show').click(function(){
        $('.window-notebook-list').css("display" , "flex");
    });
    
    // --------------control color----------------------

    $('.blue').click(function(){
        changeColor("blue");
    });
    $('.red').click(function(){
        changeColor("red");
    });
    $('.green').click(function(){
        changeColor("green");
    });
    $('.black').click(function(){
        changeColor("black");
    });
    $('.grey').click(function(){
        changeColor("grey");
    });
    
    // --------------   notebook  ----------------------
    
    $scope.noteButton = 0;
    $scope.noteContainer = 1;
    $scope.noteAddEdit = 0; // 1 - add | 2 - edit
    $scope.currentNote;
    $scope.showPagination = false;
    
    $scope.addNoteWindow = function()
    {
        if (quantityNotes > 30)
        {
            $('.max-note-window').css("display" , "flex");
            $('.window-notebook-list').css("display" , "none");
            return;
        }
      $scope.oneNote.header = "";
      $scope.oneNote.content = "";
      $scope.noteButton = 1;
      $scope.noteContainer = 2;
      $scope.noteAddEdit = 1;
    };
    
    $scope.closeNoteInfoWindow = function()
    {
        $('.max-note-window').css("display" , "none");
        $('.window-notebook-list').css("display" , "flex");
    };
    
    $scope.editNoteWindow = function()
    {
        $scope.noteButton = 2;
        $scope.noteContainer = 2;
        $scope.noteAddEdit = 2;
    };
    
    $scope.note = [];
    $scope.oneNote = [];
    $scope.addNote = function(note){
        
        if($scope.noteAddEdit === 1)
        {
            $http.post('api/notebook.php', {
            type : 1,
            noteHeader : note.header,
            noteContent : note.content
        }).success(function(data){
            if (data.change === 0)
                console.log("Wystąpił problem z przekazaniem wartości do bazy danych!");
            else
            {
                $scope.noteButton = 0;
                $scope.noteContainer = 1;
                $scope.getFirstTenNote();
            }
        }).error(function(){
            console.log("Nie udało się dokonać zapisu notatki. Wystąpił problem w połączeniu z bazą danych!");
        });
        }
    };
    
    $scope.editNote = function(note)
    {
        if($scope.noteAddEdit === 2)
        {
            $http.post('api/notebook.php', {
                type : 4,
                noteId : $scope.currentNote,
                noteHeader : note.header,
                noteContent : note.content
            }).success(function(){
                $scope.currentNote = null;
                $scope.closeNote();
            }).error(function(){
                console.log("Nie udało się edytować notatki. Wystąpił Problem w połączeniu z bazą danych!");
            });
        }
    };
    
    $scope.deleteNote = function()
    {
        $http.post('api/notebook.php',{
            type : 5,
            noteId : $scope.currentNote
        }).success(function(){
            $scope.currentNote = null;
            $scope.closeNote();
        }).error(function(){
            console.log("Nie udało się usunąć notatki. Wystąpił Problem w połączeniu z bazą danych!");
        });
    };
    
    var allNotes;
    
    $scope.pages = [];
    var quantityNotes;
    var currentPageNumber = 1;
    var quantityPages;
    
    
    $scope.getFirstTenNote = function()
    {
        $scope.showPagination = true;
        $http.post('api/notebook.php',{
          type : 2  
        }).success(function(data){
            
            quantityNotes = data.length;
            console.log(data);
            if (quantityNotes <= 10)
            {
                $scope.showPagination = false;
                angular.forEach(data, function(value, key){
                   var element = $('#note'+key);
                   element.html(value.Note_Header);
                   element.attr('ng-click', 'openNote(' + value.Note_GID + ')');
                   $compile(element)($scope);
                });
                var quantityEdit = 10 - Object.keys(data).length;

                var number = 9;
                for(var i = 1; i <= quantityEdit; i++)
                {
                    $('#note'+number).css("margin-top", "37px");
                    number--;
                }
                console.log("pierwszy if");
            }
            else
            {
                
                allNotes = data;
                
                for(var i = 0; i < 10; i++)
                {
                    var element = $('#note' + i);
                    element.html(data[i].Note_Header);
                    element.attr('ng-click', 'openNote(' + data[i].Note_GID + ')');
                    $compile(element)($scope);
                }
                
                quantityPages = Math.ceil(quantityNotes / 10);
                setPaginationButton();
                
                console.log("Liczba notatek = " + quantityNotes + " | Liczba stron = " + number);
                
            }
            
        }).error(function(){
            console.log("Nie udało się pobrać notatek. Wystąpił Problem w połączeniu z bazą danych!");
        });
    };
    
    var setPaginationButton = function()
    {
        var counter;
        if (quantityPages < 3)
            counter = quantityPages;
        else
            counter = 3;
        
        var start;
        if (currentPageNumber < 2)
            start = 1;
        else 
            start = currentPageNumber - 1;
        
        for (var i = start; i <= counter; i++)
        {
            $scope.pages.push(i);
        }
    };
    
    
    $scope.setTenNote = function(pageNumber)
    {
        $scope.showPagination = true;
        currentPageNumber = pageNumber;
        setPaginationButton();
        for (var i = 0; i < 10; i++)
        {
            var element = $('#note' + i);
            if((i + ((pageNumber*10) - 10)) < quantityNotes)
            {
                element.html(allNotes[i + ((pageNumber*10) - 10)].Note_Header);
                element.attr('ng-click', 'openNote(' + allNotes[i + ((pageNumber*10) - 10)].Note_GID + ')');
                element.css("margin-top", "13px");
            }
            else
            {
                element.html('');
                element.attr('ng-click', '');
                element.css("margin-top", "37px");
            }
            
            $compile(element)($scope);
        }
      
    };
    
    $scope.openNote = function(gid)
    {
        $scope.showPagination = false;
        $http.post('api/notebook.php',{
           type : 3,
           noteGID : gid
        }).success(function(data){
            $scope.editNoteWindow();
            $scope.oneNote.header = data[0].Note_Header;
            $scope.oneNote.content = data[0].Note_Content;
            $scope.noteAddEdit = 2;
            $scope.currentNote = gid;
        }).error(function(){
            console.log("Nie udało się pobrać notatki. Wystąpił Problem w połączeniu z bazą danych!");
        });
    };
    
    $scope.closeNote = function()
    {
        $scope.noteButton = 0;
        $scope.noteContainer = 1;
        $scope.noteAddEdit = 0;
        $scope.getFirstTenNote();
        $scope.currentNote = null;
        $scope.noteAddEdit = 0;
    };
    
    $scope.closeNotebook = function()
    {
        $('.window-notebook-list').css("display" , "none");
    };

    $scope.urlAddress = /https?:\/\/(?:www\.|(?!www))[^\s\.]+\.[^\s]{2,}|www\.[^\s]+\.[^\s]{2,}/;
   
    
    $('#delete-abbreviation-show').click(deleteAbbreviationShow); // my_function
    $('#edit-abbreviation-show').click(editAbbreviationShow);  // my_function

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