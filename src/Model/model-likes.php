<?php

class Likes
{

    public static function totallikes($post_id)
    {
        // AFFICHAGE DES LIKES TOTAL // 
        // connexion à la base de données via PDO (PHP Data Objects) = création instance
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

        // options activées sur notre instance
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // requete SQL me permettant compter les likes d'un post
        $sql = "SELECT COUNT(*) AS total FROM 76_likes
        WHERE post_id = " . $post_id;

        // on prepare la requete pour se prémunir des injections SQL
        $stmt = $pdo->query($sql);

        // on stock le resultat de la requête dans un tableau associatif
        $likehome = $stmt->fetch(PDO::FETCH_ASSOC);

        $pdo = '';

        return $likehome['total'];
    }

    public static function alreadyLiked($post_id)
    {

        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM 76_likes
        WHERE user_id = " . $_SESSION["user_id"] . " AND post_id = " . $post_id;

        $stmt = $pdo->query($sql);

        $stmt->execute();

        if ($stmt->fetch(PDO::FETCH_ASSOC)) {
            $like = true;
        } else {
            $like = false;
        }

        $pdo = '';
        return $like;
    }
}
