<?php include_once '../../templates/head.php' ?>

<body>
    <section class="home-page">
        <div class="nav">
            <div class="nav-home">
                <h2>Afpagram <i class="fa-solid fa-camera"></i></h2>
                <p class="link"><i class="fa-solid fa-house"></i><a href="./controller-home.php">Accueil</a></p>
                <div class="search">
                    <label for="site-search"><i class="fa-solid fa-magnifying-glass"></i></label>
                    <input type="search" id="site-search" name="q">
                </div>
                <p class="link"><i class="fa-regular fa-square-plus"></i><a href="./controller-creation.php">Créer</a></p>
                <div class="nav-profile">
                    <img src="/assets/img/users/<?= $_SESSION['user_id'] . '/' . $_SESSION['user_avatar'] ?>"> <a href="./controller-profile.php">Profil</a>
                </div>
                <p class="link"><i class="fa-solid fa-arrow-right-from-bracket"></i><a href="./controller-deconnexion.php">Déconnexion</a></p>
            </div>
            <div class="nav-small">
                <h2><i class="fa-solid fa-camera"></i></h2>
                <a href="./controller-home.php"><i class="fa-solid fa-house"></i></a>
                <div class="search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <a href="./controller-creation.php"><i class="fa-regular fa-square-plus"></i></a>
                <div class="nav-profile">
                <a href="./controller-profile.php"><img src="/assets/img/users/<?= $_SESSION['user_id'] . '/' . $_SESSION['user_avatar'] ?>"></a>
                </div>
                <a href="./controller-deconnexion.php"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
            </div>
        </div>
        <div class="home-posts">
            <?php foreach ($allPosts as $post) { ?>
                <div class="publication">
                    <div class="top">
                        <b><?= $post['user_pseudo']; ?></b> <span><?= date("d/m/Y - H:i", $post['post_timestamp']) ?></span>
                    </div>
                    <img src="/assets/img/users/<?= $post['user_id'] . '/' . $post['pic_name'] ?>">
                    <div class="bottom">
                        <div class="stat">
                        <?php if (Likes::alreadyLiked($post['post_id'])) { ?>
                            <button data-postlike="<?= $post['post_id'] ?>">
                                <i class="fa-solid fa-heart"></i>
                            </button>
                        <?php } else { ?>
                            <button data-postlike="<?= $post['post_id'] ?>">
                                <i class="fa-regular fa-heart"></i>
                            </button>
                        <?php } ?>
                            <span><?= Likes::totallikes($post['post_id']) ?></span>
                            <i class="fa-regular fa-comment"></i>
                            <span><?= Comments::totalcomments($post['post_id']) ?></span>
                        </div>
                        <div class="desc">
                            <span><?= $post['user_pseudo'] ?></span>
                            <p><?= $post['post_description'] ?></p>
                        </div>
                        <div class="comments">
                            <div class="commentaire">
                                <i class="fa-solid fa-comment"></i>
                                <p><a href="./controller-post.php?post=<?= $post['post_id'] ?>">Voir tous les commentaires</a></p>
                                <i class="fa-regular fa-square-plus"></i>
                                <p><a href="./controller-post.php?post=<?= $post['post_id'] ?>">commenter</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
</body>

</html>