<?php

require_once '../../config.php';

// super globale $_GET 
// var_dump($_GET); 

// super globale $_POST 
// var_dump($_POST);

//pas de chiffres
//pas de vide
//pas de caractère spéciaux

$errors = [];

//regex pour le formulaire 
$regex_name = "/^[a-zA-Z]+$/";

// NOM 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['nom'])) {
        if (empty($_POST['nom'])) {
            $errors['nom'] = 'ce champ est obligatoire';
        } elseif (!preg_match($regex_name, $_POST['nom'])) {
            $errors['nom'] = 'caractère non autorisé';
        }
    }


// PRENOM

    if (isset($_POST['prénom'])) {
        if (empty($_POST['prénom'])) {
            $errors['prénom'] = 'ce champ est obligatoire';
        } elseif (!preg_match($regex_name, $_POST['prénom'])) {
            $errors['prénom'] = 'caractère non autorisé';
        }
    }


// E-MAIL
$regex_mail = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

    if (isset($_POST['email'])) {
        if (empty($_POST['email'])) {
            $errors['email'] = 'ce champ est obligatoire';
        } elseif (!preg_match($regex_mail, $_POST['email'])) {
            $errors['email'] = 'e-mail non valide';
        }
    }


// MOT DE PASSE 
$regex_password = "/^\S+$/";

    if (isset($_POST['password'])) {
        if (empty($_POST['password'])) {
            $errors['password'] = 'ce champ est obligatoire';
        } elseif (!preg_match($regex_password, $_POST['password'])) {
            $errors['password'] = 'caractère non autorisé';
        }
    }


    if (isset($_POST['password-confirm'])) {
        if (empty($_POST['password-confirm'])) {
            $errors['password-confirm'] = 'ce champ est obligatoire';
        } elseif (!preg_match($regex_password, $_POST['password-confirm'])) {
            $errors['password-confirm'] = 'caractère non autorisé';
        } elseif ($_POST['password-confirm'] != $_POST['password']) {
            $errors['password-confirm'] = 'le mot de passe ne correspond pas';
        }
    }


// DATE DE NAISSANCE 
$regex_date = "/^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/";


    if (isset($_POST['dob'])) {
        if (empty($_POST['dob'])) {
            $errors['dob'] = 'ce champ est obligatoire';
        } elseif (!preg_match($regex_date, $_POST['dob'])) {
            $errors['dob'] = 'date non valide';
        } elseif ($_POST['dob'] > "2024-12-12") {
            $errors['dob'] = "année non valide";
        }
    }

// GENRE 

$genre = ["homme", "femme", "autre"];

    if (!isset($_POST['genre'])) {
        $errors['genre'] = 'ce champ est obligatoire';
    } elseif (!in_array($_POST['genre'], $genre)) {
        $errors['genre'] = 'genre inconnu';
    }


// CONDITIONS D'UTILISATIONS 

    if (!isset($_POST['conditions'])) {
        $errors['conditions'] = "Veuillez accepter les conditions d'utilisations";
    }

    if(empty($errors)) {
        // se connecter à la DDB 
            $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS); 
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

            var_dump($pdo);

        // header('Location: controller-confirmation.php'); 
        // exit;
    }

}

// var_dump($_POST);
// var_dump($errors);

include_once '../view/view-inscription.php'; 

?>