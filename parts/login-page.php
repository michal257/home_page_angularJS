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
<form ng-submit="login(log)">
<div class="vertical-ctr">
    <div class="container text-center logged bord">
   
        <div class="row">
        <div class="col-xs-12">
            <h1>Zaloguj Się Do Swojej Strony</h1>
        </div>
        </div>
        <div class="row" style="margin-top:40px;">
            <div class="col-xs-12 col-md-4">
                <div class="input-login">
                    <label for="#"><h2>Login:</h2></label><br>
                    <input type="email" ng-model="log.login" required/>
                </div>
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="input-login">
                    <label for="#"><h2>Hasło:</h2></label><br>
                    <input type="password" ng-model="log.pass" required/>
                </div>
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="input-login">
                    <button id="zaloguj" type="submit">Zaloguj</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <span ng-if="user.error">Podano błędny login lub haslo !</span>
            </div>
        </div>
    </div>
</div>
</form>
</aside>
