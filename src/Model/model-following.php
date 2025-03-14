<?php

function totalfollowing($user_id)
{
    // AFFICHAGE DES COMMENTAIRES // 
    // connexion à la base de données via PDO (PHP Data Objects) = création instance
    $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

    // options activées sur notre instance
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // requete SQL me permettant de rechercher tous les posts
    $sql = "SELECT user_id, user_pseudo, COUNT(fav_id) as favorites FROM `76_favorites`
            NATURAL JOIN `76_users` 
            WHERE user_id = " . $user_id; 

    // on prepare la requete pour se prémunir des injections SQL
    $stmt = $pdo->query($sql);

    // on stock le resultat de la requête dans un tableau associatif
    $following = $stmt->fetch(PDO::FETCH_ASSOC);

    $pdo = '';

    return $following['favorites'];
}

?>