<?php
    echo form_open('', 'class="form-register text-center needs-validation"');
?>
<!--<form class="form-register text-center needs-validation" novalidate>-->
    <i class="far fa-smile fa-6x"></i>
    <h4 class="h4 mb-4">VisageLivre</h4>
    <h1 class="h3 mb-3 font-weight-normal">Veuillez renseigner les champs</h1>
    <div class="mb-2 text-left">
        <label for="name">Nom</label>
        <input type="text" class="form-control" id="name" placeholder="Nom"   name="userName" required>
        <div class="invalid-feedback">
            Un nom est requis.
        </div>
    </div>
    <div class="mb-2 text-left">
        <label for="inputEmail">Adresse mail</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Adresse mail"  name="userEmail" required autofocus>
        <div class="invalid-feedback">
            Un mail valide est requis.
        </div>
    </div>
    <div class="mb-2 text-left">
        <label for="inputPassword">Mot de passe</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Mot de passe"  name="userPassword" required>
    </div>
    <div class="mb-2 text-left">
        <label for="inputPassword2">Mot de passe</label>
        <input type="password" id="inputPassword2" class="form-control" placeholder="Mot de passe" required>
        <div class="invalid-feedback">
            Un mot de passe valide est requis.
        </div>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit" name="creation">Création</button>
    <h6 class="h6">Déjà un compte? <?php echo anchor('VisageLivreControler/index/signin', 'Connectez vous'); ?></h6>

</form>