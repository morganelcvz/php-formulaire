<?php include_once '../../templates/head.php' ?>

<body>
    <div class="main">
        <h2>Formulaire d'inscription</h2>
        <form method="post" novalidate>
            <label for="nom">Nom</label>
            <span class="required"><?= $errors['nom'] ?? '' ?></span>
            <input type="text" id="nom" name="nom" value="<?= $_POST['nom'] ?? '' ?>">
            <br>
            <label for="prénom">Prénom</label>
            <span class="required"><?= $errors['prénom'] ?? '' ?></span>
            <input type="text" id="prénom" name="prénom" value="<?= $_POST['prénom'] ?? '' ?>">
            <br>
            <label for="email">E-mail</label>
            <span class="mail-error"><?= $errors['email'] ?? '' ?></span>
            <input type="email" id="email" name="email" value="<?= $_POST['email'] ?? '' ?>">
            <br>
            <label for="password">Mot de passe</label>
            <span class="mail-error"><?= $errors['password'] ?? '' ?></span>
            <input type="password" id="password" name="password" value="<?= $_POST['password'] ?? '' ?>">
            <br>
            <label for="password-confirm">Confirmation du mot de passe</label>
            <span class="mdp-error"><?= $errors['password-confirm'] ?? '' ?></span>
            <input type="password" id="password-confirm" name="password-confirm" value="<?= $_POST['password-confirm'] ?? '' ?>">
            <br>
            <label for="dob">Date de naissance</label>
            <span class="required"><?= $errors['dob'] ?? '' ?></span>
            <input type="date" id="dob" name="dob" value="<?= $_POST['dob'] ?? '' ?>">
            <br>
            <label for="genre">Genre</label>
            <span class="required"><?= $errors['genre'] ?? '' ?></span>
            <select name="genre" id="genre">
                <option value="" selected disabled></option>
                <option value="homme" <?= isset($_POST['genre']) && $_POST['genre'] == 'homme' ? 'selected' : '' ?>>Homme</option>
                <option value="femme" <?= isset($_POST['genre']) && $_POST['genre'] == 'femme' ? 'selected' : '' ?>>Femme</option>
                <option value="autre" <?= isset($_POST['genre']) && $_POST['genre'] == 'autre' ? 'selected' : '' ?>>Autre</option>
            </select>
            <br>
            <div class="check">
                <input type="checkbox" id="conditions" name="conditions" value="1">
                <label for="conditions">accepter les conditions d'utilisation</label>
                <br />
                <br />
                <?php if (isset($errors['conditions'])) { ?>
                    <span class="accept"><?= $errors['conditions']?></span>
                <?php } ?>

            </div>
            <div class="send">
                <button type="submit">envoyer</button>
            </div>
        </form>
    </div>
</body>

</html>