<header>
<div class="container text-center navbar-fixed-top navClass">
    <nav>
        <div class="row ">    

            <div class="col-xs-6 col-sm-2 col-md-1 col-md-offset-4 aDiv">
                <div class="glyphicon glyphicon-wrench aDiv icon-margin prompt-delete" id="setings-window-show" style="color:#5F9F9F;"><div class="promptMenu">Ustawienia</div></div>       
                <div class="glyphicon glyphicon-align-center aDiv prompt-delete" id="notebook-window-show" style="color:#a6a6a6;" ng-click="getFirstTenNote()"><div class="promptMenu">Notatki</div></div>       
            </div>
            
            <div class="col-xs-6 col-sm-2 col-md-1 aDiv">
                <div class="glyphicon glyphicon-pencil aDiv icon-margin prompt-edit" id="edit-abbreviation-show" style="color:#FE9A2E;"><div class="promptMenu">Edytuj skrót lub katalog</div></div>
                <div class="glyphicon glyphicon-trash aDiv prompt-delete" id="delete-abbreviation-show" style="color:#FF0000;"><div class="promptMenu">Usuń skrót lub katalog</div></div>       
            </div>
            <div class="col-xs-6 col-sm-2 col-md-1 aDiv">
                <div class="glyphicon glyphicon-plus aDiv icon-margin prompt-add"  id="abbreviation-window-open" style="color:#80FF00;"><div class="promptMenu">Dodaj skrót lub katalog</div></div> 
                <a href="#/login-page" class="glyphicon glyphicon-off prompt-logout" style="color:#0040FF;"><div class="promptMenu">Wyloguj</div></a>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-2 col-xs-offset-5 menu">MENU</div>
        </div>
    </nav>
</div>
</header>

<aside>
    <div class="vertical-ctr">
        <div class="abbreviations">
            <div class="container text-center logged container-fluid">
                <div class="row abbreviations_one">

                    <div class="col-xs-4 col-sm-3 col-md-1" id="abbreviation{{abbreviation.id}}" ng-repeat="abbreviation in abbreviations" ng-if="abbreviation.id_catalog == 1">

                        <a href="{{abbreviation.url}}" target="_blank" class="link-abbreviation2">
                            <div class="abbreviation text-center" style="background-image: url('image/{{abbreviation.color}}.png');">{{abbreviation.icon}}</div>
                            <div class="abbreviation-text text-center">{{abbreviation.name}}</div>
                        </a>
                        <a class="delete glyphicon glyphicon-trash" ng-click="deletingShow(abbreviation.id, 1, abbreviation.name)" ></a>
                        <a class="edit glyphicon glyphicon-pencil" ng-click="editingShow(abbreviation.id, abbreviation.color, abbreviation.name, abbreviation.url, abbreviation.icon)"></a>
                    </div>
                </div>

                <div class="row catalogs_one">
                    <div class="col-xs-4 col-sm-3 col-md-1" id="catalog{{catalog.id_catalog}}" ng-repeat="catalog in catalogs" ng-if="catalog.nr_catalog == 0">

                        <a href="#/catalog-page/{{catalog.id_catalog}}" class="link-abbreviation2">
                            <div class="abbreviation text-center" style="background-image: url('image/{{catalog.color}}.svg');">{{catalog.icon}}</div>
                            <div class="abbreviation-text text-center">{{catalog.name_catalog}}</div>
                        </a>
                        <a class="delete glyphicon glyphicon-trash" ng-click="deletingShow(catalog.id_catalog, 2, catalog.name_catalog)"></a></a>
                        <a class="edit glyphicon glyphicon-pencil" ng-click="editingCatalogShow(catalog.id_catalog, catalog.color, catalog.name_catalog, catalog.icon)"></a>
                    </div>
                </div>
                <span ng-if="add.error">Nie udało się dodać Twojego katalogu !</span>
                <span ng-if="add.error1">Nie udało się dodać Twojego skrótu !</span>
            </div>
        </div>
    </div>
</aside>


     
    <!--_____________________OKNO DODAWANIA SKROTU_________________________-->
 <form ng-submit="addAbbreviation( abbreviation )" name="addAbbreviationForm">
    <div class="vertical-ctr navbar-fixed-top abbreviation-add window">
   
        <div class="container text-center">
            <div class="row">
                <div class="col-xs-12 col-md-5 col-md-offset-4 bord">
                    <div class="row">
                        <div class="col-xs-2 col-xs-offset-5 col-md-2 col-md-offset-5">
                            <div class="abbreviation" style="background-image: url('image/{{abbreviation.color}}.png');"><span>{{abbreviation.icon}}</span></div>   
                            <div class="abbreviation-text" style="width: 90px">{{abbreviation.name}}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <span>Nawa:</span>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="name" ng-model="abbreviation.name" ng-pattern="nameAbbreviation" ng-minlength="2" ng-maxlength="20" required/>
                            <span class="label-error" ng-if="!addAbbreviationForm.name.$valid && addAbbreviationForm.name.$dirty">Wpisz 2-20 znaków!</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <span>Adres Strony:</span>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="url" ng-model="abbreviation.url" ng-pattern="urlAddress" required/>
                            <span class="label-error" ng-if="!addAbbreviationForm.url.$valid && addAbbreviationForm.url.$dirty">Wpisz poprawny adres!</span>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-6">
                            <span>Kolor:</span>
                        </div>
                        <div class="col-md-6">
                            <div class="color-box blue"></div>
                            <div class="color-box red"></div>
                            <div class="color-box green"></div>
                            <div class="color-box grey"></div>
                            <div class="color-box black"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <span>Symbol <br />(max trzy znaki)</span>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="icon" ng-model="abbreviation.icon" ng-minlength="1" ng-maxlength="3" required/>
                            <span class="label-error" ng-if="!addAbbreviationForm.icon.$valid && addAbbreviationForm.icon.$dirty">Wpisz 2-3 znaki!</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit">Zapisz</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="closeAddAbbreviation">Anuluj</button>
                        </div>
                    </div> 
                </div>
            </div>
        </div><!--container-->
    </div>
</form> 
      
    
<!--_____________________OKNO DODAWANIA KATALOGU_________________________-->
    
<form ng-submit="addCatalog( catalog )" name="addCatalogForm">
    <div class="vertical-ctr navbar-fixed-top catalog-add window">
        <div class="container text-center">
            <div class="row">
                <div class="col-xs-12 col-md-5 col-md-offset-4 bord">
                    <div class="row">
                        <div class="col-xs-2 col-xs-offset-5 col-md-2 col-md-offset-5">
                            <div class="abbreviation" style="background-image: url('image/{{catalog.color}}.svg');"><span>{{catalog.icon}}</span></div>   
                            <div class="abbreviation-text" style="width: 90px">{{catalog.name}}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <span>Nawa:</span>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="name" ng-model="catalog.name" ng-minlength="2" ng-maxlength="20" required/>
                            <span class="label-error" ng-if="!addCatalogForm.name.$valid && addCatalogForm.name.$dirty">Wpisz 2-20 znaków!</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <span>Kolor:</span>
                        </div>
                        <div class="col-md-6">
                            <div class="color-box blue"></div>
                            <div class="color-box red"></div>
                            <div class="color-box green"></div>
                            <div class="color-box grey"></div>
                            <div class="color-box black"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <span>Symbol <br />(max cztery znaki)</span>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="icon" ng-model="catalog.icon" ng-minlength="1" ng-maxlength="4" required/>
                            <span class="label-error" ng-if="!addCatalogForm.icon.$valid && addCatalogForm.icon.$dirty">Wpisz 2-4 znaki!</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit">Zapisz</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="closeAddAbbreviation">Anuluj</button>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</form>
    
<!--___________________________OKNO WYBORU___________________________-->

<!--<div class="dialog-window" id="selection-window">-->
    <div class="vertical-ctr navbar-fixed-top select-window window">
    <div class="container text-center">
        <div class="row bord">
            <div class="col-xs-12 col-md-4">
                <button id="abbreviation-add-open-btn">Dodaj Skrót</button>
            </div>

            <div class="col-xs-12 col-md-4">
                <button id="catalog-add-open-btn">Dodaj Katalog</button>
            </div>

            <div class="col-xs-12 col-md-4">
                <button id="close-dialog-window-btn">Anuluj</button>
            </div>
        </div>
    </div>
    </div>
<!--</div>-->  

<!--___________________________OKNO USOWANIA YES NO___________________________-->

<!--<div class="dialog-window" id="selection-window">-->
    <div class="vertical-ctr navbar-fixed-top delete-window window">
    <div class="container text-center">
        
        <div class="row">
            <h2>Czy napewno chcesz usunąć {{windowYesNo.type}} {{windowYesNo.name}} ?</h2>
            <h5 ng-if="windowYesNo.type == 'katalog'">Wraz z katalogiem usunięte zostaną także wszystkie zawarte w nim skróty.</h5>
        </div>
        
        <div class="row">
            <div class="col-xs-12 col-md-8 col-md-offset-2">
                <div class="row bord">
                    <div class="col-xs-12 col-md-6">
                        <button ng-click="deleting(windowYesNo.type)">Usuń</button>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <button id="close-delete-window-btn">Anuluj</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
<!--</div>-->  


    <!--_____________________OKNO EDYCJI SKROTU_________________________-->
<form  ng-submit="editSave( abbreviationEdit )" name="editAbbreviation">
    <div class="vertical-ctr navbar-fixed-top abbreviation-edit window">
        <div class="container text-center">
            <div class="row">
                <div class="col-xs-12 col-md-5 col-md-offset-4 bord">
                    <div class="row">
                        <div class="col-xs-2 col-xs-offset-5 col-md-2 col-md-offset-5">
                            <div class="abbreviation edit-background" style="background-image: url('image/{{abbreviationEdit.color}}.png');"><span>{{abbreviationEdit.icon}}</span></div>   
                            <div class="abbreviation-text" style="width: 90px">{{abbreviationEdit.name}}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <span>Nazwa:</span>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="name" ng-model="abbreviationEdit.name" ng-pattern="nameAbbreviation" ng-minlength="2" ng-maxlength="20" required/>
                            <span class="label-error" ng-if="!editAbbreviation.name.$valid && editAbbreviation.name.$dirty">Wpisz 2-20 znaków!</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <span>Adres Strony:</span>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="url" ng-model="abbreviationEdit.url" ng-pattern="urlAddress" required/>
                            <span class="label-error" ng-if="!editAbbreviation.url.$valid && editAbbreviation.url.$dirty">Wpisz poprawny adres!</span>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-6">
                            <span>Kolor:</span>
                        </div>
                        <div class="col-md-6">
                            <div class="color-box blue"></div>
                            <div class="color-box red"></div>
                            <div class="color-box green"></div>
                            <div class="color-box grey"></div>
                            <div class="color-box black"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <span>Symbol <br />(max trzy znaki)</span>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="icon" ng-model="abbreviationEdit.icon" ng-minlength="1" ng-maxlength="3" required/>
                            <span class="label-error" ng-if="!editAbbreviation.icon.$valid && editAbbreviation.icon.$dirty">Wpisz 2-3 znaki!</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit">Zapisz Zmiany</button>
                            <!-- ng-click="editSave(abbreviationEdit.id, abbreviationEdit.color, abbreviationEdit.icon, abbreviationEdit.name, abbreviationEdit.url)" -->
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="closeAddAbbreviation">Anuluj</button>
                        </div>
                    </div> 
                </div>
            </div>
        </div><!--container-->
    </div>
    </form>
    
    <!--_____________________OKNO EDYCJI KATALOGU_________________________-->
    
<form ng-submit="editCatalogSave( catalogEdit )" name="editCatalogForm">
    <div class="vertical-ctr navbar-fixed-top catalog-edit window">
        <div class="container text-center">
            <div class="row">
                <div class="col-xs-12 col-md-5 col-md-offset-4 bord">
                    <div class="row">
                        <div class="col-xs-2 col-xs-offset-5 col-md-2 col-md-offset-5">
                            <div class="abbreviation edit-background" style="background-image: url('image/{{catalogEdit.color}}.svg');"><span>{{catalogEdit.icon}}</span></div>   
                            <div class="abbreviation-text" style="width: 90px">{{catalogEdit.name}}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <span>Nawa:</span>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="name" ng-model="catalogEdit.name" ng-minlength="2" ng-maxlength="20" required/>
                            <span class="label-error" ng-if="!editCatalogForm.name.$valid && editCatalogForm.name.$dirty">Wpisz 2-20 znaków!</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <span>Kolor:</span>
                        </div>
                        <div class="col-md-6">
                            <div class="color-box blue"></div>
                            <div class="color-box red"></div>
                            <div class="color-box green"></div>
                            <div class="color-box grey"></div>
                            <div class="color-box black"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <span>Symbol <br />(max dwa znaki)</span>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="icon" ng-model="catalogEdit.icon" ng-minlength="1" ng-maxlength="4" required />
                            <span class="label-error" ng-if="!editCatalogForm.icon.$valid && editCatalogForm.icon.$dirty">Wpisz 1-4 znaki!</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit">Zapisz</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="closeAddAbbreviation">Anuluj</button>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</form>
    
<!--___________________________setings___________________________-->

<!--<div class="dialog-window" id="selection-window">-->
    <div class="vertical-ctr navbar-fixed-top setings-window window">
    <div class="container text-center">
        
        <div class="row">
            <h2>Ustawienia</h2>
        </div>
        
        <div class="row">
            <div class="col-xs-12 col-md-8 col-md-offset-2">
                <div class="row bord">
                    <div class="col-xs-12 col-md-6">
                        <button id="open-wallpapers-window">Ustawienia tła</button>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <button id="close-window-setings">Anuluj</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
<!--</div>-->  


<!--___________________________ wallpaper all __________________________-->

<!--<div class="dialog-window" id="selection-window">-->
    <div class="vertical-ctr navbar-fixed-top window-wallpapers-all window">
    <div class="container text-center">
        
        <div class="row">
            <h2>Ustawienia tapety !!!!!</h2>
        </div>
        
        <div class="row">
            <div class="col-md-2 col-md-offset-10">
                <div id="close-window-wallpaper-all" class="glyphicon glyphicon-remove-circle" style="font-size: 30px; cursor: pointer;"></div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-2" ng-repeat="wallpaper in wallpapers">
                
                <div ng-click="selectWallpaper( wallpaper )">
               <img src="wallpapers/200px/{{wallpaper.wall}}.jpg" alt="Moja Strona">
               </div>
            </div>
        </div>
        
        
    </div>
    </div>
<!--</div>-->  

<!--___________________________ wallpaper one __________________________-->

<div class="vertical-ctr navbar-fixed-top window-wallpaperOne window">
    <div class="container text-center">
        
        <div class="row">
            <img src="wallpapers/1000px/{{wallpaperOne.path}}.jpg" alt="wallpaper">
        </div>
        
        <div class="row">
            <div class="col-xs-12 col-md-8 col-md-offset-2" style=" border: 1px solid white">
                <div class="col-xs-12 col-md-6">
                    <button ng-click="setWallpaper(wallpaperOne)">Ustaw tło</button>
                </div>
                <div class="col-xs-12 col-md-6">
                    <button id="close-window-wallpaperOne">Anuluj</button>
                </div>
            </div>
        </div>
   
    </div>
</div>

<!--___________________________ notebook __________________________-->


<div class="vertical-ctr navbar-fixed-top window-notebook-list window">

    <div class="container text-center " style="width:100%; ">
        
        <div class="row" style="max-height:90vh;">
            <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-4 col-md-offset-4" style=" ">
                
                <div class="notebook-header">
                
                    <div class="row ">
                        <div class="col-xs-12 ">

                        </div>
                    </div>
                    
                </div>
                
                <div class="notebook-container">
                
                    <div class="notebook-container1" ng-if="noteContainer === 1">
                    
                        <div class="row">
                            <div class="col-xs-10 col-xs-offset-1 temp" id="note0">
                                
                            </div>
                            <div class="col-xs-10 col-xs-offset-1 temp" id="note1">
                                
                            </div>
                            <div class="col-xs-10 col-xs-offset-1 temp" id="note2">
                                
                            </div>
                            <div class="col-xs-10 col-xs-offset-1 temp" id="note3">
                               
                            </div>
                            <div class="col-xs-10 col-xs-offset-1 temp" id="note4">
                                
                            </div>
                            <div class="col-xs-10 col-xs-offset-1 temp" id="note5">
                                
                            </div>
                            <div class="col-xs-10 col-xs-offset-1 temp" id="note6">
                                
                            </div>
                            <div class="col-xs-10 col-xs-offset-1 temp" id="note7">
                                
                            </div>
                            <div class="col-xs-10 col-xs-offset-1 temp" id="note8">
                                
                            </div>
                            <div class="col-xs-10 col-xs-offset-1 temp" id="note9">
                                
                            </div>

                        </div>
                    </div>
                    
                    <form ng-submit="addNote(oneNote); editNote(oneNote)" ng-if="noteContainer === 2">
                        
                        <div class="notebook-container2">

                            <input type="text" name="noteHeader" ng-model="oneNote.header" placeholder="Nagłówek" id="noteHeader"/>

                            <textarea placeholder="Treść" ng-model="oneNote.content" id="noteContent"></textarea>

                        </div>
                        
                        <div class="row double-button-notebook" ng-if="noteButton === 1">
                            <div class="col-xs-12 col-sm-6">
                                <button class="notebook-button" ng-click="addNote()" type="submit">Zapisz notatkę</butonn>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <button class="notebook-button" type="button" ng-click="closeNote()">Zamknij</button>
                            </div>
                        </div>
                        <div class="row double-button-notebook" ng-if="noteButton === 2">
                            <div class="col-xs-12 col-sm-4">
                                <button class="notebook-button" ng-click="editNote()">Zapisz zmiany</button>
                            </div>
                            <div class="col-xs-12 col-sm-4">
                                <button class="notebook-button" ng-click="deleteNote()">Usuń notatkę</button>
                            </div>
                            <div class="col-xs-12 col-sm-4">
                                <button class="notebook-button" ng-click="closeNote()">Zamknij notatkę</button>
                            </div>
                        </div>
                        
                    </form>
                    
                    <div ng-if="showPagination">
                        <ul class="pagination">
                            <li ng-repeat="page in pages" ng-click='setTenNote(page)'>
                                <a>{{page}}</a>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="row double-button-notebook" ng-if="noteButton === 0">
                        <div class="col-xs-12 col-sm-6">
                            <button class="notebook-button" ng-click="addNoteWindow()">Dodaj notatkę</butonn> 
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <button class="notebook-button" ng-click="closeNotebook()">Zamknij notatnik</butonn> 
                        </div>     
                    </div>
                
                </div>
                    
            </div>
  
        </div>


    </div>
</div>

<div class="vertical-ctr navbar-fixed-top max-note-window window">
    <div class="container text-center">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-sm-offset-3 bord">
                <h2>Możesz dodać maksymalnie 30 notatek !</h2>
                <h3>Aby dodać nowe notatki musisz usunąć wcześniej dodane.</h3>
                <button ng-click="closeNoteInfoWindow()">OK</button>
            </div>
        </div>
    </div>
</div>