<?php
    echo form_open("signin", 'class="form-signin text-center"');
?>
<!--<form class="form-signin text-center">-->
    <i class="far fa-smile fa-6x"></i>
    <h4 class="h4 mb-4">VisageLibre</h4>
    <h1 class="h3 mb-3 font-weight-normal">Veuillez vous connecter</h1>
    <label for="inputEmail" class="sr-only">Adresse mail</label>
    <input type="email" id="inputEmail" class="form-control" placeholder="Adresse mail" required autofocus>
    <label for="inputPassword" class="sr-only">Mot de passe</label>
    <input type="password" id="inputPassword" class="form-control" placeholder="Mot de passe" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Connexion</button>
    <h6 class="h6">Pas de compte? <a href="#">Enregistrez vous</a></h6>
</form>