<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--    <link rel="icon" type="image/png" href="./static/images/" />-->

    <meta name="description" content="">
    <meta name="keywords" content="" lang="fr">
    <meta name="author" content="Nicolas Jousset, Vincent Le Quec">

    <link rel="stylesheet" type="text/css" href="../static/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../static/bootstrap/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="../static/fontawesome/css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="../static/css/style.css">

    <title>Visage Livre</title>
</head>
<body>

    <section>
    
        <?php $this->load->view($content); ?>    
    
    </section>
    
    <footer>
        <div class="container-fluid">
            <div class="row">
                <div>
                    <p class="text-center">© Copyright VisageLibre 2018 | <a href="#">Mentions légales</a></p>
                </div>
                <div>
                    <ul class="list-inline text-center btn-social">
                        <li>
                            <a href="https://www.linkedin.com/in/vincent-le-quec/" target="_blank">
                                <i class="fab fa-linkedin"></i></a>
                        </li>
                        <li>
                            <a href="https://gitlab.com/vincent.le-quec" target="_blank">
                                <i class="fab fa-gitlab"></i></a>
                        </li>
                        <li>
                            <a href="https://github.com/Venatum" target="_blank">
                                <i class="fab fa-github"></i></a>
                        </li>
                        <li>
                            <a href="mailto:vincentlequec@gmail.com">
                                <i class="fas fa-envelope"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
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
