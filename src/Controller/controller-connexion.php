<?php

session_start(); 
// var_dump($_SESSION);

require_once '../../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // IDENTIFIANT

    if (isset($_POST['identifiant'])) {
        if (empty($_POST['identifiant'])) {
            $errors['identifiant'] = 'ce champ est obligatoire';
        }
    }

    // MOT DE PASSE 
    $regex_password = "/^\S+$/";

    if (isset($_POST['password'])) {
        if (empty($_POST['password'])) {
            $errors['password'] = 'ce champ est obligatoire';
        }
    }

    if (!empty($_POST['identifiant']) && !empty($_POST['password'])) {

        // se connecter à la DDB via PDO (PHP DATA OBJECT) = création d'instance
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

        // options activées sur notre instance
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM `76_users` WHERE user_pseudo = :identifiant or user_mail = :identifiant";

        // on prépare la requête pour se prémunir des injections sql 
        $stmt = $pdo->prepare($sql);

        // on bind la valeur du post 
        $stmt->bindValue(':identifiant', $_POST['identifiant'], PDO::PARAM_STR);

        // on execute la requete 
        $stmt->execute();

        // on compte les résultats, on crée une variable $found qui sera un booleen 
        $stmt->rowCount() == 0 ? $found = false : $found = true;

        // on stock le résultat de la requête dans un tableau associatif 
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($found == false) {
            $errors['connexion'] = 'identifiant ou mot de passe incorrect';
        } else { 
            if(password_verify($_POST['password'], $user['user_password'])){
                $_SESSION = $user;
                header('Location: controller-profile.php');
                exit;
            } else {
                $errors['connexion'] = 'identifiant ou mot de passe incorrect';
            }
        }
    }
}

include_once '../View/view-connexion.php';
