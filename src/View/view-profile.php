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
        <section class="profile-page">
            <section class="profile">
                <div class="profile-top">
                <img src="../../assets/img/users/<?= $_SESSION['user_id'] . '/' . $_SESSION['user_avatar'] ?>" class="p-large">
                    <div class="info">
                        <div class="profile-name">
                        <img src="../../assets/img/users/<?= $_SESSION['user_id'] . '/' . $_SESSION['user_avatar'] ?>" class="p-small">
                            <span><?= $_SESSION['user_pseudo'] ?></span>
                            <button class="btn-big">modifier le profil</button>
                            <buttton class="btn-small"><i class="fa-solid fa-gear"></i></button>
                        </div>
                        <div class="profile-stat">
                            <p><b><?= totalposts($_SESSION['user_id']) ?></b> publications</P>
                            <p><b><?= totalfollowers($_SESSION['user_id']) ?></b> followers</p>
                            <P><b><?= totalfollowing($_SESSION['user_id']) ?></b> following</p>
                        </div>
                    </div>
                </div>
                <div class="profile-post">

                    <?php foreach ($allPosts as $post) { ?>
                        <div class="post-row">
                            <div class="post-img" style="background:url(../../assets/img/users/<?= $post['user_id'] . '/' . $post['pic_name'] ?>);background-size:cover;background-position:center;">
                                <div class="post-stat">
                                    <i class="fa-regular fa-heart"></i>
                                    <i class="fa-regular fa-comment"></i>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </section>
        </section>
    </section>
</body>

</html>