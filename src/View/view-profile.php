<?php include_once '../../templates/head.php' ?>

<body>

    <section class="profile">
        <div class="profile-top">
            <img src="../../assets/img/users/<?= $_SESSION['user_id'] . '/' . $_SESSION['user_avatar'] ?>">
            <div class="info">
                <div class="profile-name">
                    <span><?= $_SESSION['user_pseudo'] ?></span>
                    <button>modifier le profil</button>
                    <a href="./controller-home.php">Accueil</a>
                </div>
                <div class="profile-stat">
                    <p><b>97</b> publications</P>
                    <p><b>200</b> followers</p>
                    <P><b>300</b> following</p>
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
</body>

</html>