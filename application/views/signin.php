<?php
    echo form_open("", 'class="form-signin text-center"');
?>
<!--<form class="form-signin text-center">-->
    <i class="far fa-smile fa-6x"></i>
    <h4 class="h4 mb-4">VisageLivre</h4>
    <h1 class="h3 mb-3 font-weight-normal">Veuillez vous connecter</h1>
    <label for="inputEmail" class="sr-only" >Adresse mail</label>
    <input type="email" name="inputEmail" class="form-control" placeholder="Adresse mail" required autofocus>
    <label for="inputPassword" class="sr-only" >Mot de passe</label>
    <input type="password" name="inputPassword" class="form-control" placeholder="Mot de passe" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit" name="connection">Connexion</button>
    <h6 class="h6">Pas de compte? <?php echo anchor('VisageLivreControler/index/register', 'Enregistrez vous'); ?> </h6> 
</form>