<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel="icon" type="image/png" href="./static/images/" />-->

    <meta name="description" content="">
    <meta name="keywords" content="" lang="fr">
    <meta name="author" content="Nicolas Jousset, Vincent Le Quec">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('application/static/bootstrap/css/bootstrap.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('application/static/bootstrap/css/bootstrap-theme.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('application/static/fontawesome/css/fontawesome-all.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('application/static/css/style.css')?>">
    <title>Visage Livre</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand offset-2" href="<?php echo base_url('application/views/home.php') ?>">
            <i class="far fa-smile"></i>
            VisageLivre
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse offset-6" id="navbarSupportedContent">
            <!--<form class="form-inline offset-3">-->
            <!--<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">-->
            <!--<button class="btn btn-info my-2 my-sm-0" type="submit">Search</button>-->
            <!--</form>-->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
					<!-- <a class="nav-link" href=" --> <?php echo anchor('VisageLivreControler/index/home', "Accueil"); ?>
					<!-- title="Accueil">Accueil</a> -->
                </li>
                <li class="nav-item">
                    <?php echo anchor('VisageLivreControler/index/signout', "Se déconnecter"); ?>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('application/views/register.php') ?>" title="S'inscrire">S'inscrire</a>
                </li>
                <!--<li class="nav-item">-->
                <!--<button class="dropdown-item">-->
                <!--<i class="far fa-bell fa-2x"></i>-->
                <!--</button>-->
                <!--</li>-->
            </ul>
        </div>
    </nav>

    <section>
    
        <?php 
            $this->load->view($content);
        ?>    
    
    </section>

    <footer class="bg-dark footer sticky-bottom">
        <div class="mx-auto d-flex justify-content-center">
            <p class="">© Copyright VisageLivre 2018 | <a href="#">Mentions légales</a></p>
        </div>
    </footer>

    <!--JQuery-->
    <script src="<?php echo base_url('application/static/jquery-3.3.1.min.js') ?>"></script>
    <!--Bootstrap-->
    <script src="<?php echo base_url('application/static/bootstrap/js/bootstrap.min.js') ?>"></script>
    <!--JS-->
    <script src="<?php echo base_url('application/static/js/style.js') ?>"></script>
</body>

</html>
