<?php 

session_start();

if(!isset($_SESSION['user_id'])){
    header('Location: ../../public');
    exit;
}

require_once '../../config.php';
require_once '../Model/model-following.php';
require_once '../Model/model-followers.php';
require_once '../Model/model-posts.php';

// se connecter à la DDB via PDO (PHP DATA OBJECT) = création d'instance
$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS); 

// options activées sur notre instance
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

// requête sql pour afficher tous les posts
$sql = "SELECT * FROM `76_posts` NATURAL JOIN `76_pictures` WHERE `user_id` = :user_id";

// on prépare la requête pour se prémunir des injections sql 
$stmt = $pdo->prepare($sql);

// on bind la valeur du post 
$stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT); 

// on execute la requete 
$stmt->execute(); 

$allPosts = $stmt->fetchAll(PDO::FETCH_ASSOC);

$pdo = '';

// var_dump($allPosts);

?>

<?php include_once '../View/view-profile.php' ?>

