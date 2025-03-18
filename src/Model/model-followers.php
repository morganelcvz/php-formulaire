<?php

function totalfollowers($user_id)
{
    // AFFICHAGE DES FOLLOWERS TOTAL // 
    // connexion à la base de données via PDO (PHP Data Objects) = création instance
    $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

    // options activées sur notre instance
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // requete SQL me permettant de compter tous les followers d'un utilisateur
    $sql = "SELECT 76_favorites.fav_id, COUNT(76_favorites.user_id) AS follower
            FROM `76_favorites`
            INNER JOIN `76_users` ON 76_favorites.user_id = 76_users.user_id
            WHERE fav_id = " . $user_id;

    // on prepare la requete pour se prémunir des injections SQL
    $stmt = $pdo->query($sql);

    // on stock le resultat de la requête dans un tableau associatif
    $followers = $stmt->fetch(PDO::FETCH_ASSOC);

    $pdo = '';

    return $followers['follower'];
}

?>