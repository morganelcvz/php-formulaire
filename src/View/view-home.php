<?php include_once '../../templates/head.php' ?>

<body>
    <section class="home-page">
        <div class="nav">
            <div class="nav-home">
                <h2>Afpagram <i class="fa-solid fa-camera"></i></h2>
                <p class="link"><i class="fa-solid fa-house"></i><a href="#">Accueil</a></p>
                <div class="search">
                    <label for="site-search"><i class="fa-solid fa-magnifying-glass"></i></label>
                    <input type="search" id="site-search" name="q">
                </div>
                <p class="link"><i class="fa-regular fa-square-plus"></i><a href="#">Créer</a></p>
                <div class="nav-profile">
                    <img src="/assets/img/users/12/profil12.png"> <a href="./controller-profile.php">Profil</a>
                </div>
                <p class="link"><i class="fa-solid fa-arrow-right-from-bracket"></i><a href="./controller-deconnexion.php">Déconnexion</a></p>
            </div>
        </div>
        <div class="home-posts">
        <?php foreach ($allPubli as $post) { ?>
            <div class="publication">
                <div class="top">
                    <b>pseudonyme</b> <span><?=$post['post_timestamp'];?></span>
                </div>
                <img src="/assets/img/users/13/chien.png">
                <div class="bottom">
                    <div class="stat">
                        <i class="fa-regular fa-heart"></i>
                        <i class="fa-regular fa-comment"></i>
                    </div>
                    <div class="desc">
                        <span>pseudonyme</span>
                        <p><?= $post['post_description']; ?></p>
                    </div>
                    <div class="commentaire">
                        <span>pseudonyme</span>
                        <p>C'est une super photo elle est incroyable !</p>
                    </div>
                    <div class="add-commentaire">
                        <input type="text" id="comment" title="comment" name="comment" placeholder="ajouter un commentaire...">
                        <button type="submit">commenter</button>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
    </section>
</body>

<!-- <div class="publication">
                <div class="top">
                    <b>pseudonyme</b> <span>timestamp</span>
                </div>
                <img src="/assets/img/users/13/chien.png">
                <div class="bottom">
                    <div class="stat">
                        <i class="fa-regular fa-heart"></i>
                        <i class="fa-regular fa-comment"></i>
                    </div>
                    <div class="desc">
                        <span>pseudonyme</span>
                        <p>description de la photo !</p>
                    </div>
                    <div class="commentaire">
                        <span>pseudonyme</span>
                        <p>C'est une super photo elle est incroyable !</p>
                    </div>
                    <div class="add-commentaire">
                        <input type="text" id="comment" title="comment" name="comment" placeholder="ajouter un commentaire...">
                        <button type="submit">commenter</button>
                    </div>
                </div>
            </div> -->

</html>