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
        <div class="one-post">
            <div class="post">
                <div class="post-image" style="background:url(../../assets/img/users/<?= $post['user_id'] . '/' . $post['pic_name'] ?>);background-size:cover;background-position:center;">
                </div>
                <div class="left-post">
                    <div class="post-desc">
                        <img src="/assets/img/users/<?= $post['user_id'] . '/' . $post['user_avatar'] ?>">
                        <p><span class="post-name"><?= $post['user_pseudo'] ?></span>
                            <?= $post['post_description'] ?>
                            <br />
                            <br />
                            <b><?= date("d/m/Y - H:i", $post['post_timestamp']) ?></b>
                            <br />
                            <?php if ($post['user_id'] == $_SESSION['user_id']) { ?>
                                <span class="post-edit">
                                    <a href="#">
                                        <button>
                                            <i class="fa-solid fa-pen-to-square"></i> éditer
                                        </button>
                                    </a>
                                    <a href="./controller-delete_posts.php?post_id=<?= $post['post_id'] ?>">
                                        <button><i class="fa-solid fa-square-xmark"></i> supprimer</button>
                                    </a>
                                </span>
                            <?php } ?>
                        </p>
                    </div>
                    <div class="post-comments">
                        <?php foreach ($comments as $comment) { ?>
                            <div class="comment">
                                <p>
                                    <b><?= $comment['user_pseudo'] ?></b>
                                    <span><?= $comment['com_text'] ?></span>
                                </p>
                                <span>
                                    <?= date("d/m/Y - H:i", $comment['com_timestamp']) ?>
                                    <?php if ($comment['user_id'] == $_SESSION['user_id']) { ?>
                                        <a href="#">
                                            <button>
                                                <i class="fa-solid fa-pen"></i> éditer
                                            </button>
                                        </a>
                                        <a href="./controller-delete_comments.php?post_id=<?= $comment['post_id'] ?>&com_id=<?= $comment['com_id'] ?>">
                                            <button><i class="fa-solid fa-delete-left"></i> supprimer</button>
                                        </a>
                                    <?php } ?>
                                </span>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="post-stats">
                        <?php if (Likes::alreadyLiked($post['post_id'])) { ?>
                            <button data-postlike="<?= $post['post_id'] ?>">
                                <i class="fa-solid fa-heart"></i>
                            </button>
                        <?php } else { ?>
                            <button data-postlike="<?= $post['post_id'] ?>">
                                <i class="fa-regular fa-heart"></i>
                            </button>
                        <?php } ?>
                        <span><?= $likes['total'] ?></span>
                        <i class="fa-regular fa-comment"></i>
                        <span><?= count($comments) ?></span>
                    </div>
                    <form class="add-commentaire" method="post" novalidate>
                        <input type="text" id="comment" title="comment" name="comment" placeholder="<?= $errors['comment'] ?? 'écrire un commentaire...' ?>">
                        <button type="submit">commenter</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </section>
</body>

</html>