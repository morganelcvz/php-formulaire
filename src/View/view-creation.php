<?php include_once '../../templates/head.php' ?>

<body>

    <body class="bg-primary">

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
    </body>

    </html>