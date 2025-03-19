<?php

session_start();

require_once '../../config.php';
require_once '../Model/model-comments.php';
require_once '../Model/model-likes.php';

// on controle si la personne est bien loggée
if (!isset($_SESSION['user_id'])) {
    // on renvoie vers la page d'accueil si non
    header('Location: ../../public/');
    exit;
}

// AFFICHAGE DE TOUS LES POSTS // 
// connexion à la base de données via PDO (PHP Data Objects) = création instance
$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

// options activées sur notre instance
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sqlFav = "SELECT GROUP_CONCAT(fav_id) FROM 76_favorites WHERE `user_id` = " . $_SESSION['user_id'] . " GROUP BY `user_id`";

$favorites = $pdo->query($sqlFav);

$fav = $favorites->fetchColumn(); 

// requete SQL me permettant de rechercher tous les posts
$sql = "SELECT * FROM `76_posts` NATURAL JOIN `76_users` NATURAL JOIN `76_pictures` WHERE `user_id` IN (" . $fav . "," .
$_SESSION['user_id'] . ") ORDER BY `post_timestamp` DESC;";

// on prepare la requete pour se prémunir des injections SQL
$stmt = $pdo->query($sql);

// on stock le resultat de la requête dans un tableau associatif
$allPosts = $stmt->fetchAll(PDO::FETCH_ASSOC);

$pdo = '';

?>

<?php include_once '../View/view-home.php' ?>

