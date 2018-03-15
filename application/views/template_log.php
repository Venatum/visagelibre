<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel="icon" type="image/png" href="./static/images/" />-->

    <meta name="description" content="">
    <meta name="keywords" content="" lang="fr">
    <meta name="author" content="Nicolas Jousset, Vincent Le Quec">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('application/static/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('application/static/bootstrap/css/bootstrap-theme.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('application/static/fontawesome/css/fontawesome-all.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('application/static/css/style.css') ?>">

    <title>Visage Livre</title>
</head>
<body>
    <section>
        <?php
            
            $this->load->view($content);
            
        ?>
    </section>

    <footer class="bg-dark" style="position:fixed;bottom: 0;width: 100%">
        <div class="mx-auto d-flex justify-content-center">
            <p class="">© Copyright VisageLibre 2018 | <a href="#">Mentions légales</a></p>
        </div>
    </footer>

    <!--JQuery-->
    <script src="../static/jquery-1.11.1.js"></script>
    <!--Bootstrap-->
    <script src="../static/bootstrap/js/bootstrap.min.js"></script>
    <!--JS-->
    <script src="../static/js/style.js"></script>
</body>

</html>
