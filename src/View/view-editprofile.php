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
        <section class="creation">
            <h2>éditer le profil</h2> 
            <form action="" method="POST" enctype="multipart/form-data" novalidate>

                <div class="add-photo">
                    <label for="pfp" class="form-label">Photo de profil :</label>
                    <input type="file" class="form-control" id="pfp" name="pfp" required>
                    <div class="invalid-feedback"><?= $errors['pfp'] ?? '' ?></div>
                </div>

                <div class="add-comment">
                    <label for="bio" class="form-label">Pseudo :</label>
                    <input type="text" id="pseudo" name="pseudo" value="<?= $_SESSION['user_pseudo'] ?>" required>
                    <div class="invalid-feedback"><?= $errors['pseudo'] ?? '' ?></div>
                </div>

                <div class="add-comment">
                    <label for="bio" class="form-label">Description du profil :</label>
                    <textarea class="form-control" rows="3" id="bio" name="bio" placeholder="Description..." required><?= $_SESSION['user_bio'] ?></textarea>
                    <div class="invalid-feedback"><?= $errors['bio'] ?? '' ?></div>
                </div>

                <div class="add-save">
                    <button>Enregistrer</button>
                    <a href="../Controller/controller-editprofile.php">Annuler</a>
                </div>
            </form>
        </section>
    </section>
</body>

</html>