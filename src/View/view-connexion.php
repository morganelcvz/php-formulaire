<?php include_once '../../templates/head.php' ?>

<body>
    <div class="main">
        <h2>Connexion</h2>
        <form>
            <label for="email">E-mail</label>
            <input type="email" id="email" title="email">
            <br>
            <label for="password">Mot de passe</label>
            <input type="password" id="password" title="password">
            <br>
            <div class="connect">
                <button type="submit">se connecter</button>
                <a href="../Controller/controller-inscription.php">inscription</a>
            </div>
        </form>
    </div>
</body>

</html>