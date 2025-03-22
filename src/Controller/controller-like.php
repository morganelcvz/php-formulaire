<?php
session_start();
include_once '../../config.php';
include_once '../Model/model-likes.php';


$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// Si l'user a déjà liké, alors on supprime le like
if (Likes::alreadyLiked($_GET['post'])) {


    $sql = "DELETE FROM `76_likes` WHERE `post_id` = " . $_GET['post'] . " AND `user_id` = " . $_SESSION['user_id'];

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    echo ("unliked");

    // Si l'user n'a pas liké, alors on l'ajoute du tableau likes
} else {

    $sql = "INSERT INTO `76_likes` (`user_id`, `post_id`) VALUES (" . $_SESSION['user_id'] . ", " . $_GET['post'] . ")";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    echo ("liked");
}