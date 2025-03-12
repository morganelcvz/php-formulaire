<?php

session_start();

require_once '../../config.php';

// on controle si la personne est bien loggée
if (!isset($_SESSION['user_id'])) {
    // on renvoie vers la page d'accueil si non
    header('Location: ../../public/');
    exit;
}

// connexion à la base de données via PDO (PHP Data Objects) = création instance
$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

// options activées sur notre instance
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// requete SQL me permettant de rechercher tous les posts
$sql = "SELECT * FROM `76_posts`
INNER JOIN `76_comments`
ON 76_comments.post_id = 76_posts.post_id
INNER JOIN `76_users` 
ON 76_users.user_id = 76_comments.user_id 
INNER JOIN `76_pictures` 
ON 76_pictures.post_id = 76_posts.post_id
WHERE 76_posts.post_id = " . $_GET['post']; 

// on prepare la requete pour se prémunir des injections SQL
$stmt = $pdo->query($sql);

// on stock le resultat de la requête dans un tableau associatif
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

$pdo = '';

// var_dump($comments); 

// connexion à la base de données via PDO (PHP Data Objects) = création instance
$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

// options activées sur notre instance
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// requete SQL me permettant de rechercher tous les posts
$sql = "SELECT * FROM `76_posts`
INNER JOIN `76_users` 
ON 76_users.user_id = 76_posts.user_id 
INNER JOIN `76_pictures` 
ON 76_pictures.post_id = 76_posts.post_id
WHERE 76_posts.post_id = " . $_GET['post']; 

// on prepare la requete pour se prémunir des injections SQL
$stmt = $pdo->query($sql);

// on stock le resultat de la requête dans un tableau associatif
$post = $stmt->fetch(PDO::FETCH_ASSOC);

$pdo = '';

// var_dump($post); 

?>

<?php include_once '../View/view-post.php' ?>