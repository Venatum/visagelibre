<section class="container-fluid row">
    <!-- Profile -->
    <div id="profile" class="col-md-2 myCard">
        <div class="container-fluid text-center">
            <h4>Mon Profile</h4>
            <p><img src=" <?php echo base_url('application/static/images/avatar3.png') ?>" alt="Avatar" class="avatar">
            </p>
            <hr>
            <p><i class="fas fa-at"></i> <?php echo $_SESSION['user']['nickname'] ?> </p>
            <p><i class="fas fa-envelope"></i> <?php echo $_SESSION['user']['email'] ?> </p>
            <button type="button" class="btn btn-link float-right" onclick="displayParam(this);"
                    style="margin-top: -5%">
                <i class="fas fa-ellipsis-h"></i></button>
            <div class="collapsed m-1">
                <button type="button" class="btn btn-danger" name="deleteUser">Supprimer votre compte</button>
            </div>
            <br>
            <hr>
            <div>
                <h4>Mes amis</h4>
                <?php foreach ($friend as getFriends($_SESSION['user']['nickname'])) { ?>
                    <form class="container-fluid m-auto row">
                        <h5 class="m-auto"><?php echo $friend['nickname'] ?></h5>
                        <button type="submit" class="btn btn-outline-danger" title="Supprimer" name="deleteFriend"
                                value="<?php echo $friend['nickname'] ?>">
                            <i class="far fa-times-circle"></i></button>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>

    <!--News Section-->
    <div class="col-md-6 m-auto">
        <!--News Input-->
        <form class="container-fluid myCard p-3" method="post">
            <h5 class="h5">Exprimez-vous</h5>
            <input contenteditable="true" placeholder="Exprimez-vous..." name="inputPost" required style="margin-bottom: 1%; width: 100%"/><br>
            <button name="publier" type="submit" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> &nbsp;Publier</button>
        </form>

        <!--News-->
        <?php //foreach ( ?? as $publication) ?>
        <form class="container-fluid myCard p-3"><br>
            <input name="idRef" style="display: none" value="iddoc"/>
            <div style="text-align: center; margin: -5% 0 -5% 0;">
                <span class="float-right">create_date</span><br/>
                <img src=" <?php echo base_url('application/static/images/avatar3.png') ?>" alt="Nickname" class="avatar" style="width: 60px;height: 60px">
                <h4>Nickname</h4><br>
            </div>
            <hr>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                aliquip ex ea commodo consequat.</p>
            <button type="button" class="btn btn-primary" onclick="displayComment(this);">
                <i class="far fa-comment"></i> &nbsp;Commenter
            </button>
            <button type="button" class="btn btn-danger float-right" name="deleteComment">
                Supprimer <i class="far fa-times-circle"></i>
            </button>

            <div class="collapsed">
                <div class="container-fluid myCard p-3">

                    <!--Comment-->
                    <?php //foreach ( ?? as $comment) ?>
                    <div class="container-fluid">
                        <div class="col-md-2" style="margin: 0 0 -10% 0;">
                            <img src=" <?php echo base_url('application/static/images/avatar3.png') ?>" alt="Nickname" class="avatar" style="width: 60px;height: 60px">
                            <h6>Nickname</h6>
                        </div>
                        <p class="col-md-9 m-auto text-justify">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                            exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                        <span class="float-right text-muted">create_date</span><br>
                        <hr>
                    </div>
                    <?php //endforeach; ?>

                    <!-- Comment input-->
<!--                    <form>-->
                        <h5 class="h5">Exprimez-vous</h5>
                        <input contenteditable="true" name="inputComment" placeholder="Votre commentaire..." required style="margin-bottom: 1%; width: 100%"/><br>
                        <button type="submit" class="btn btn-primary" name="comment">
                            <i class="fas fa-pencil-alt"></i> &nbsp;Commenter
                        </button>
<!--                    </form>-->
                </div>
            </div>
        </form>
        <?php //endforeach; ?>
    </div>

    <!--Friends-->
    <div class="col-md-2 mx-auto myCard p-1" id="friends">
        <div class="container-fluid text-center">
            <h3>Amis</h3><hr>
            <div>
                <h4>Demande d'amis</h4>
                <?php foreach ( $friendRequest as getFriendsRequestToUser($_SESSION['user']['nickname'])) { ?>
                <form class="container-fluid m-auto row">
                    <h5 class="m-auto"><?php echo $friendRequest['nickname'] ?></h5>
                    <button type="submit" class="btn btn-outline-success mx-1" title="Accepter"><i class="far fa-check-circle"></i></button>
                    <button type="submit" class="btn btn-outline-danger" title="Décliner"><i class="far fa-times-circle"></i></button>
                </form>
                <?php } ?>
            </div>
            <hr>
            <div>
                <h4>Ajouter des amis</h4>
                <?php foreach ($unknown as getUnknownUser($_SESSION['user']['nickname'])) { ?>
                <form class="container-fluid m-auto row">
                    <h5 class="m-auto"><?php echo $unknown['nickname'] ?></h5>
                    <button type="submit" class="btn btn-outline-success mx-1" title="Ajouter"><i class="fas fa-plus"></i></button>
                </form>
                <?php } ?>
            </div>
        </div>
    </div>

    <script>
        function displayParam(e) {
            $(e).next().toggle("slow", function () {});
        }

        function displayComment(e) {
            $(e).next().next().toggle("slow", function () {});
        }
    </script>
</section>
