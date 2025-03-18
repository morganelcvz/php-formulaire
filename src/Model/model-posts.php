<?php

function totalposts($user_id)
{
    // AFFICHAGE DES POSTS TOTAL // 
    // connexion à la base de données via PDO (PHP Data Objects) = création instance
    $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

    // options activées sur notre instance
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // requete SQL me permettant de compter le nombre total de posts fait par un utilisateur
    $sql = "SELECT 76_users.user_id, 76_users.user_pseudo, COUNT(76_posts.post_id) AS posts
            FROM `76_users`
            LEFT JOIN `76_posts` ON 76_users.user_id = 76_posts.user_id
            WHERE 76_users.user_id = " . $user_id; 

    // on prepare la requete pour se prémunir des injections SQL
    $stmt = $pdo->query($sql);

    // on stock le resultat de la requête dans un tableau associatif
    $allposts = $stmt->fetch(PDO::FETCH_ASSOC);

    $pdo = '';

    return $allposts['posts'];
}

?>