<script>
        function displayParam(e) {
            $(e).next().toggle("slow", function () {});
        }

        function displayComment(e) {
            $(e).next().next().toggle("slow", function () {});
        }
    </script>
<section class="container-fluid row">
    <!-- Profile -->
    <div class="col-md-2 mx-auto myCard p-1" id="profile">
        <div class="container-fluid text-center">
            <h4>Mon Profile</h4>
            <img src=" <?php echo base_url('application/static/images/avatar3.png') ?>" alt="Avatar" class="avatar">
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
                <?php 
                $tab = $this->Users_model->getFriends($_SESSION['user']['nickname']);
                foreach ($tab as $friend) { ?>
                    <form class="container-fluid m-auto row">
                        <h5 class="m-auto"><?php echo ($friend['nickname'] == $_SESSION['user']['nickname'] ? $friend['friend'] : $friend['nickname'])?></h5>                        <button type="submit" class="btn btn-outline-danger" title="Supprimer" name="deleteFriend"
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
        <?php
        $tab = $this->Users_model->getPostByUser($_SESSION['user']['nickname']);
        foreach ($tab as $post) { 
            print_r($post);
                ?>
            <form class="container-fluid myCard p-3"><br>
                <input name="idRef" style="display: none" value="<?php echo $post['iddoc'] ?>"/>
                <div style="text-align: center; margin: -5% 0 -5% 0;">
                    <span class="float-right"><?php echo $post['create_date'] ?></span><br/>
                    <img src=" <?php echo base_url('application/static/images/avatar3.png') ?>" alt="Nickname"
                         class="avatar" style="width: 60px;height: 60px">
                    <h4><?php echo $post['auteur'] ?></h4><br>
                </div>
                <hr>
                <p><?php echo $post['content'] ?></p>
                <button type="button" class="btn btn-primary" onclick="displayComment(this);">
                    <i class="far fa-comment"></i> &nbsp;Commenter
                </button>
                <button type="button" class="btn btn-danger float-right" name="deletePost">
                    Supprimer <i class="far fa-times-circle"></i>
                </button>

                <div class="collapsed">
                    <div class="container-fluid myCard p-3">

                        <!--Comment-->
                        <?php
                        $comments = $this->Users_model->getCommentByIdPost($post['iddoc']);
                        foreach ($comments as $data) {
                        print_r($data);?>
                            <div class="container-fluid">
                                <div class="col-md-2" style="margin: 0 0 -10% 0;">
                                    <img src=" <?php echo base_url('application/static/images/avatar3.png') ?>"
                                         alt="Nickname" class="avatar" style="width: 60px;height: 60px">
                                    <h6><?php echo $data['auteur'] ?></h6>
                                </div>
                                <p class="col-md-9 m-auto text-justify"><?php echo $data['content'] ?></p>
                                <span class="float-right text-muted"><?php echo $data['create_date'] ?></span><br>
                                <hr>
                            </div>
                        <?php } ?>

                        <!-- Comment input-->
                        <h5 class="h5">Exprimez-vous</h5>
                        <input contenteditable="true" name="inputComment" placeholder="Votre commentaire..." required
                               style="margin-bottom: 1%; width: 100%"/><br>
                        <button type="submit" class="btn btn-primary" name="comment">
                            <i class="fas fa-pencil-alt"></i> &nbsp;Commenter
                        </button>
                    </div>
                </div>
            </form>
        <?php } ?>
    </div>

    <!--Friends-->
    <div class="col-md-2 mx-auto myCard p-1 friends">
        <div class="container-fluid text-center">
            <h3>Amis</h3><hr>
            <div>
                <h4>Demande d'amis</h4>
                <?php 
            $tab = $this->Users_model->getFriendsRequestToUser($_SESSION['user']['nickname']);
            foreach ( $tab as $friendRequest ) { ?>
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
                <?php 
                $tab = $this->Users_model->getUnknownUser($_SESSION['user']['nickname']);
                foreach ($tab as $unknown ) { ?>
                <form class="container-fluid m-auto row">
                    <h5 class="m-auto"><?php echo ($unknown['nickname'] == $_SESSION['user']['nickname'] ? $unknown['friend'] : $unknown['nickname'])?></h5>
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
