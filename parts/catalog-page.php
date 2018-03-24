<header>
<div class="container text-center navbar-fixed-top navClass">
    <nav>
        <div class="row ">
            <!--<div class="col-xs-6 col-sm-4 col-md-2 col-md-offset-3 aDiv"><a href="#/home">Rejestracja</a></div>
            <div class="col-xs-6 col-sm-4 col-md-2 aDiv" ><a href="#">Info</a></div>-->

            <div class="col-xs-6 col-sm-2 col-md-1 col-md-offset-5 aDiv">
                <div class="glyphicon glyphicon-pencil aDiv icon-margin prompt-edit" id="edit-abbreviation-show" style="color:#FE9A2E;"><div class="promptMenu">Edytuj skrót lub katalog</div></div>
                <div class="glyphicon glyphicon-trash aDiv prompt-delete" id="delete-abbreviation-show" style="color:#FF0000;"><div class="promptMenu">Usuń skrót lub katalog</div></div>       
            </div>
            <div class="col-xs-6 col-sm-2 col-md-1 aDiv">
                 <div class="glyphicon glyphicon-plus aDiv icon-margin prompt-add"  id="abbreviationInCatalog-window-open" style="color:#80FF00;"><div class="promptMenu">Dodaj skrót lub katalog</div></div> 
                <a href="#/login-page" class="glyphicon glyphicon-off prompt-logout" style="color:#0040FF;"><div class="promptMenu">Wyloguj</div></a>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-2 col-xs-offset-5 menu"><span>MENU</span></div>
        </div>
    </nav>
</div>
</header>

<aside>
    <div class="vertical-ctr">
        <div class="abbreviations">
            <div class="container text-center logged container-fluid">
                <div class="row abbreviations_one">

                    <div class="col-xs-4 col-sm-3 col-md-1" id="abbreviation{{abbreviation.id}}" ng-repeat="abbreviation in abbreviations" >

                        <a href="http://{{abbreviation.url}}" target="_blank" class="link-abbreviation2">
                            <div class="abbreviation text-center" style="background-image: url('image/{{abbreviation.color}}.png');">{{abbreviation.icon}}</div>
                            <div class="abbreviation-text text-center">{{abbreviation.name}}</div>
                        </a>
                        <a class="delete glyphicon glyphicon-trash" ng-click="deletingShow(abbreviation.id, abbreviation.name)"></a>
                        <a class="edit glyphicon glyphicon-pencil"></a>
                    </div>
                <!--<div class="abbreviation-box">
                    <div class="abbreviation"><p>G</p></div>
                    <div class="abbreviation-text">Dodaj skrót</div>
                </div> -->
                </div>
                <span ng-if="add.error">Nie udało się dodać Twojego skrótu!</span>
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
                            <input type="text" name="name" ng-model="abbreviation.name" ng-pattern="nameAbbreviation" ng-minlength="1" ng-maxlength="20" required/>
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
    
<!--___________________________OKNO USOWANIA YES NO___________________________-->

<!--<div class="dialog-window" id="selection-window">-->
    <div class="vertical-ctr navbar-fixed-top delete-window window">
    <div class="container text-center">
        
        <div class="row">
            <h2>Czy napewno chcesz usunąć skrót: {{windowYesNo.name}} ?</h2>
        </div>
        
        <div class="row">
            <div class="col-xs-12 col-md-8 col-md-offset-2">
                <div class="row bord">
                    <div class="col-xs-12 col-md-6">
                        <button ng-click="deleting()">Usuń</button>
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





