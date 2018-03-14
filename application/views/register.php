<?php
    echo form_open('register', 'class="form-register text-center needs-validation"');
?>
<!--<form class="form-register text-center needs-validation" novalidate>-->
    <i class="far fa-smile fa-6x"></i>
    <h4 class="h4 mb-4">VisageLibre</h4>
    <h1 class="h3 mb-3 font-weight-normal">Veuillez renseigner les champs</h1>
    <div class="row">
        <div class="col-md-6 mb-2 text-left">
            <label for="firstName">Prénom</label>
            <input type="text" class="form-control" id="firstName" placeholder="Prénom" required>
            <div class="invalid-feedback">
                Un prénom valide est requis.
            </div>
        </div>
        <div class="col-md-6 mb-2 text-left">
            <label for="lastName">Nom</label>
            <input type="text" class="form-control" id="lastName" placeholder="Nom" required>
            <div class="invalid-feedback">
                Un nom valide est requis.
            </div>
        </div>
    </div>
    <div class="mb-2 text-left">
        <label for="inputEmail">Adresse mail</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Adresse mail" required autofocus>
        <div class="invalid-feedback">
            Un mail valide est requis.
        </div>
    </div>
    <div class="mb-2 text-left">
        <label for="inputPassword">Mot de passe</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Mot de passe" required>
    </div>
    <div class="mb-2 text-left">
        <label for="inputPassword2">Mot de passe</label>
        <input type="password" id="inputPassword2" class="form-control" placeholder="Mot de passe" required>
        <div class="invalid-feedback">
            Un mot de passe valide est requis.
        </div>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Création</button>
    <h6 class="h6">Déjà un compte? <a href="#">Connectez vous</a></h6>
</form>