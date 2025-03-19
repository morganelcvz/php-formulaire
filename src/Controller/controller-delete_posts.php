<?php 

session_start();

require_once '../../config.php';
require_once '../Model/model-posts.php';

// on controle si la personne est bien loggée
if (!isset($_SESSION['user_id'])) {
    // on renvoie vers la page d'accueil si non
    header('Location: ../../public/');
    exit;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['post_id'])) {
        Posts::deletepost($_GET['post_id'], $_SESSION['user_id']); 
        header('Location: controller-home.php'); 
        exit; 
    }
}

?>