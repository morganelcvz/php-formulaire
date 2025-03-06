<?php include_once '../../templates/head.php' ?>

<body>

    <section class="profile">
        <div class="profile-top">
            <img src="https://placehold.co/200x200">
            <div class="info">
                <div class="profile-name">
                    <span><?= $_SESSION['user_pseudo'];?></span>
                    <button>modifier le profil</button>
                    <button><a href="./controller-deconnexion.php">déconnexion</a></button>
                </div>
                <div class="profile-stat">
                    <p><b>97</b> publications</P>
                    <p><b>200</b> followers</p>
                    <P><b>300</b> following</p>
                </div>
                <button>Ajouter un nouveau post</button>
            </div>
        </div>
        <div class="profile-post">
        
        <?php foreach ($allPosts as $post) { ?>
            <div class="post-row">
            <div class="post-img" style="background:url(../../assets/img/users/<?= $post['user_id'] . '/' . $post['pic_name']; ?>);background-size:cover;background-position:center;"></div>
            </div>
        <?php } ?>
        

            <!-- <div class="post-row">
                <div class="post-img" style="background:url(https://placehold.co/500x500);background-size:cover;background-position:center;"></div>
                <div class="post-img" style="background:url(https://placehold.co/500x500);background-size:cover;background-position:center;"></div>
                <div class="post-img" style="background:url(https://placehold.co/500x500);background-size:cover;background-position:center;"></div>
            </div>
            <div class="post-row">
                <div class="post-img" style="background:url(https://placehold.co/500x500);background-size:cover;background-position:center;"></div>
                <div class="post-img" style="background:url(https://placehold.co/500x500);background-size:cover;background-position:center;"></div>
                <div class="post-img" style="background:url(https://placehold.co/500x500);background-size:cover;background-position:center;"></div>
            </div> -->
        </div>
    </section>

</body>

</html>