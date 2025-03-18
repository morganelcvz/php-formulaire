<?php

function totalcomments($post_id)
{
    // AFFICHAGE DES COMMENTAIRES TOTAL // 
    // connexion à la base de données via PDO (PHP Data Objects) = création instance
    $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

    // options activées sur notre instance
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // requete SQL me permettant de compter tous les commentaires d'un post
    $sql = "SELECT COUNT(*) AS total FROM 76_comments
    WHERE post_id = " . $post_id;

    // on prepare la requete pour se prémunir des injections SQL
    $stmt = $pdo->query($sql);

    // on stock le resultat de la requête dans un tableau associatif
    $comments = $stmt->fetch(PDO::FETCH_ASSOC);

    $pdo = '';

    return $comments['total'];
}

?>