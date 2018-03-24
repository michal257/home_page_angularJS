<header>
<div class="container text-center navbar-fixed-top">
    <nav>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-2 col-md-offset-8"><a href="#/register">Rejestracja</a></div>
            <div class="col-xs-12 col-sm-6 col-md-2" ><a href="#/home">Info</a></div>
        </div>
    </nav>
</div>
</header>
<aside>
<form ng-submit="activation ( active ) ">
<div class="vertical-ctr">
    <div class="container text-center logged bord">
   
        <div class="row">
            <div class="col-xs-12 col-md-6 col-md-offset-3">
                <h1>Aktywuj dostęp do swojej strony</h1><br>
                <label for="#"><h3>Podaj kod otrzymany w wiadomości e-mail</h3></label>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-4 col-md-offset-4">
                <div class="input-login">
                    <input type="text" ng-model="active.key" placeholder="Tu wpisz kod" required/>
                </div>
            </div>
        </div>
       
        <div class="row">
            <div class="col-xs-12">
                <span ng-if="activate.error">Podano nieprawidłowy kod aktywacyjny !</span>
            </div>
        </div>
         <div class="row">
            <div class="col-xs-12 col-md-4 col-md-offset-4">
                <div class="input-login">
                    <button type="submit">Zaloguj</button>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
</aside>
