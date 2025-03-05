<?php include_once '../../templates/head.php' ?>

<body>
    <div class="main">
        <h2>Connexion</h2>
        <form method="post" novalidate>
            <label for="email">Identifiant</label>
            <span class="required"><?= $errors['identifiant'] ?? '' ?></span>
            <input type="text" id="identifiant" title="identifiant" name="identifiant" value="<?= $_POST['identifiant'] ?? '' ?>">
            <br>
            <label for="password">Mot de passe</label>
            <span class="required"><?= $errors['password'] ?? '' ?></span>
            <input type="password" id="password" title="password" name="password" value="<?= $_POST['password'] ?? '' ?>">
            <br>
            <span class="required" style="margin-top:1rem;"><?= $errors['connexion'] ?? '' ?></span>
            <div class="connect">
                <button type="submit">se connecter</button>
                <a href="../Controller/controller-inscription.php">inscription</a>
            </div>
        </form>
    </div>
</body>

</html>