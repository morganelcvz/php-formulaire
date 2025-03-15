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

            <h2>nouveau post</h2>
            <form action="" method="POST" enctype="multipart/form-data" novalidate>

                <div class="add-photo">
                    <label for="photo" class="form-label">Photo :</label>
                    <input type="file" class="form-control" id="photo" name="photo" required>
                    <div class="invalid-feedback"><?= $errors['photo'] ?? '' ?></div>
                </div>

                <div class="add-comment">
                    <label for="description" class="form-label">Description :</label>
                    <textarea class="form-control" rows="3" id="description" name="description" placeholder="Description..." required></textarea>
                    <div class="invalid-feedback"><?= $errors['description'] ?? '' ?></div>
                </div>

                <div class="add-save">
                    <button>Enregistrer</button>
                    <a href="../Controller/controller-connexion.php" class="btn btn-outline-secondary w-100">Annuler</a>
                </div>
            </form>
        </section>
    </section>
</body>

</html>