<?php 

session_start();

if(!isset($_SESSION['user_id'])){
    header('Location: ../../public');
    exit;
}

require_once '../../config.php';

// se connecter à la DDB via PDO (PHP DATA OBJECT) = création d'instance
$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS); 

// options activées sur notre instance
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

// requête sql pour afficher tous les posts
$sql = "SELECT * FROM 76_posts WHERE user_id in (
    (SELECT group_concat(fav_id) FROM 76_favorites WHERE user_id = :user_id
    GROUP BY user_id),:user_id
    )"; 

// on prépare la requête pour se prémunir des injections sql 
$stmt = $pdo->prepare($sql);

// on bind la valeur du post 
$stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT); 

// on execute la requete 
$stmt->execute(); 

$allPubli = $stmt->fetchAll(PDO::FETCH_ASSOC);

$pdo = '';

?>


<?php include_once '../View/view-home.php' ?>

