<?php

session_start();

require_once '../../config.php';
require_once '../Model/model-posts.php';
require_once '../Model/model-pictures.php';

// on controle si la personne est bien loggée
if (!isset($_SESSION['user_id'])) {
    // on renvoie vers la page d'accueil si non
    header('Location: ../../public/');
    exit;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['post_id'])) {
        $pic_name = Pictures::getPicname($_GET['post_id']);
        Posts::deletepost($_GET['post_id'], $_SESSION['user_id']);
        unlink("../../assets/img/users/" . $_SESSION['user_id'] . "/" . $pic_name);
        header('Location: controller-home.php');
        exit;
    }
}
