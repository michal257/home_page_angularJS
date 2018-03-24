<header>
<div class="container text-center navbar-fixed-top">
    <nav>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-2 col-md-offset-8"><a href="#/login-page">Strona Logowania</a></div>
            <div class="col-xs-12 col-sm-6 col-md-2" ><a href="#">Info</a></div>
        </div>
    </nav>
</div>
</header>
<aside>
    <form ng-submit="registering (register)" name="registerForm">
<div class="vertical-ctr">
    <div class="container text-center logged">
        <div class="row">
            <div class="col-xs-12 col-md-5 col-md-offset-3 bord">
                <div class="row">
                    <div class="col-xs-12 col-md-8 col-md-offset-2">
                        <h1>Zarejestruj Się</h1>
                    </div>
                </div>
                <div class="row" style="margin-top:0px;">
                    <div class="col-xs-12 col-md-8 col-md-offset-2">
                        <div class="input-login input-register">
                            <label for="#"><h2>Imię</h2></label><br>
                            <input type="text" name="name" ng-model="register.name" ng-minlength="2" ng-maxlength="16" required/>
                            <span ng-if="!registerForm.name.$valid && registerForm.name.$dirty">Imię musi mieć od 2 do 16 znaków!</span> 
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top:0px;">
                    <div class="col-xs-12 col-md-8 col-md-offset-2">
                        <div class="input-login input-register">
                            <label for="#"><h2>Adres e-mail:</h2></label><br>
                            <input type="email" name="email" ng-model="register.email" required/>
                            <span ng-if="!!registerForm.$error.email && registerForm.email.$dirty">Wprowadź poprawny adres email!</span> 
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top:0px;">
                    <div class="col-xs-12 col-md-8 col-md-offset-2">
                        <div class="input-login input-register">
                            <label for="#"><h2>Hasło:</h2></label><br>
                            <input type="password" name="pass" ng-model="register.pass" ng-minlength="6" ng-maxlength="20" required/>
                            <span ng-if="!registerForm.pass.$valid && registerForm.pass.$dirty">Hasło musi mieć od 6 do 20 znaków!</span> 
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top:0px;">
                    <div class="col-xs-12 col-md-8 col-md-offset-2">
                        <div class="input-login input-register">
                            <label for="#"><h2>Powtórz Hasło:</h2></label><br>
                            <input type="password" name="repeatPass" ng-model="register.repeatPass" ng-minlength="6" ng-maxlength="20" required/>
                            <span ng-if="!registerForm.repeatPass.$valid && registerForm.repeatPass.$dirty">Hasło musi mieć od 6 do 20 znaków!</span> 
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top:0px;">
                    <div class="col-xs-12 col-md-8 col-md-offset-2">
                       <div>
                            <label style="cursor: pointer;">
                                <input type="checkbox" ng-model="register.check" required/>
                                Akceptuję Regulamin
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top:0px;">
                    <div class="col-xs-12 col-md-8 col-md-offset-2">
                        <div class="input-login input-register">
                            <button id="zaloguj" type="submit">Zaloguj</button>
                        </div>
                    </div>
                </div>
                <div ng-if="value.active==0" class="alert alert-danger" role="alert">Jakieś dane zostały wprowadzone niepoprawnie !</div>
                <div ng-if="value.active==2" class="alert alert-danger" role="alert">Podany adres e-mail istnieje już w bazie !</div>
            </div>
        </div>
    </div>
</div>
</form>
</aside>
