<section class="container-fluid row">
    <!-- Profile -->
    <div id="profile" class="col-md-2 myCard">
        <div class="container-fluid text-center">
            <h4>Mon Profile</h4>
            <p><img src="../static/images/avatar3.png" alt="Avatar" class="avatar"></p>
            <hr>
            <p><i class="fas fa-at"></i> <?php echo $_SESSION['user']['nickname'] ?> </p>
            <p><i class="fas fa-envelope"></i> <?php echo $_SESSION['user']['email'] ?> </p>
        </div>
    </div>

    <div class="col-md-6 m-auto">
        <!--News Input-->
        <form class="container-fluid myCard p-3">
            <h5 class="h5">Exprimez-vous</h5>
            <input contenteditable="true" placeholder="Exprimez-vous..." style="margin-bottom: 1%; width: 100%"/><br>
            <button type="submit" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> &nbsp;Publier</button>
        </form>

        <!--News-->
        <div class="container-fluid myCard p-3"><br>
            <div style="text-align: center; margin: -5% 0 -5% 0;">
                <span class="float-right">create_date</span><br/>
                <img src="../static/images/avatar3.png" alt="Nickname" class="avatar" style="width: 60px;height: 60px">
                <h4>Nickname</h4><br>
            </div>
            <hr>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                aliquip ex ea commodo consequat.</p>
            <button type="button" class="btn btn-primary" onclick="displayComment(this);">
                <i class="far fa-comment"></i> &nbsp;Commenter</button>

            <div class="collapsed">
                <div class="container-fluid myCard p-3">
                    <!--Comment-->
                    <div class="container-fluid">
                        <div class="col-md-2" style="margin: 0 0 -10% 0;">
                            <img src="../static/images/avatar3.png" alt="Nickname" class="avatar"
                                 style="width: 60px;height: 60px">
                            <h6>Nickname</h6>
                        </div>
                        <p class="col-md-9 m-auto text-justify">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                            exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                            exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                            exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                        <span class="float-right text-muted">create_date</span><br>
                        <hr>
                    </div>
                    <div class="container-fluid">
                        <div class="col-md-2" style="margin: 0 0 -10% 0;">
                            <img src="../static/images/avatar3.png" alt="Nickname" class="avatar"
                                 style="width: 60px;height: 60px">
                            <h6>Nickname</h6>
                        </div>
                        <p class="col-md-9 m-auto text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                            exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        <span class="float-right text-muted">create_date</span><br>
                        <hr>
                    </div>
                    <!-- Comment input-->
                    <form>
                        <h5 class="h5">Exprimez-vous</h5>
                        <input contenteditable="true" placeholder="Votre commentaire..."
                               style="margin-bottom: 1%; width: 100%"/><br>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> &nbsp;Commenter
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="container-fluid myCard p-3"><br>
            <div style="text-align: center; margin: -5% 0 -5% 0;">
                <span class="float-right">create_date</span><br/>
                <img src="../static/images/avatar4.png" alt="Nickname" class="avatar" style="width: 60px;height: 60px">
                <h4>Nickname</h4><br>
            </div>
            <hr>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                aliquip ex ea commodo consequat.</p>
            <button type="button" class="btn btn-primary" onclick="displayComment(this);">
                <i class="far fa-comment"></i> &nbsp;Commenter</button>
            <div class="collapsed">
                <div class="container-fluid myCard p-3">
                    <!-- Comment input-->
                    <form>
                        <h5 class="h5">Exprimez-vous</h5>
                        <input contenteditable="true" placeholder="Votre commentaire..."
                               style="margin-bottom: 1%; width: 100%"/><br>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> &nbsp;Commenter
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>
