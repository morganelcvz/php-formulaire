<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    // on renvoie vers la page profile
    header('Location: controller-profile.php');
    exit;
}

require_once '../../config.php';

// un défini un tableau vide qui contiendra les erreurs
$errors = [];


// lancement des test lors d'un POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // var_dump($_SESSION);
    // var_dump($_POST);
    // var_dump($_FILES);

    $regex_pseudo = "/^[a-zA-Z0-9_-]+$/";

    if (isset($_POST['pseudo'])) {
        if (empty($_POST['pseudo'])) {
            $errors['pseudo'] = 'ce champ est obligatoire';
        } elseif (!preg_match($regex_pseudo, $_POST['pseudo'])) {
            $errors['pseudo'] = 'caractère non autorisé';
        } 
    }

    if (empty($_POST['bio'])) {
        $errors['bio'] = 'Veuillez saisir une description';
    }

    // var_dump($errors);

    if (empty($errors)) {
        if ($_FILES['pfp']['error'] == 4) {

            // EDITER LA BIO DU PROFIL // 
            // connexion à la base de données via PDO (PHP Data Objects) = création instance
            $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

            // options activées sur notre instance
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //on stock notre requête de creation du post avec des marqueurs nominatifs
            $sql = "UPDATE `76_users` 
                SET `user_bio` = :bio
                WHERE `user_id` = :user_id";

            // on prépare la requête avant de l'exécuter
            $stmt = $pdo->prepare($sql);

            // fonction permettant de nettoyer les inputs
            function safeInput($string)
            {
                $input = trim($string);
                $input = htmlspecialchars($input);
                return $input;
            }

            // 
            $stmt->bindValue(':bio', safeInput($_POST['bio']), PDO::PARAM_STR);
            $stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);

            // Exécuter la requête
            if ($stmt->execute()) {
                $_SESSION['user_bio'] = safeInput($_POST['bio']);
                header('Location: controller-profile.php');
                exit;
            }
            
        } else {

            // EDITER LA BIO DU PROFIL // 
            // connexion à la base de données via PDO (PHP Data Objects) = création instance
            $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

            // options activées sur notre instance
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //on stock notre requête de creation du post avec des marqueurs nominatifs
            $sql = "UPDATE `76_users` 
                    SET `user_bio` = :bio
                    WHERE `user_id` = :user_id";

            // on prépare la requête avant de l'exécuter
            $stmt = $pdo->prepare($sql);

            // fonction permettant de nettoyer les inputs
            function safeInput($string)
            {
                $input = trim($string);
                $input = htmlspecialchars($input);
                return $input;
            }

            // 
            $stmt->bindValue(':bio', safeInput($_POST['bio']), PDO::PARAM_STR);
            $stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);

            // Exécuter la requête
            if ($stmt->execute()) {
                $_SESSION['user_bio'] = safeInput($_POST['bio']);
            }

            // EDITER LE PSEUDO //
            // connexion à la base de données via PDO (PHP Data Objects) = création instance
            $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

            // options activées sur notre instance
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //on stock notre requête de creation du post avec des marqueurs nominatifs
            $sql = "UPDATE `76_users` 
                    SET `user_pseudo` = :pseudo
                    WHERE `user_id` = :user_id";

            // on prépare la requête avant de l'exécuter
            $stmt = $pdo->prepare($sql);

            function safeInput($string)
            {
                $input = trim($string);
                $input = htmlspecialchars($input);
                return $input;
            }

            // 
            $stmt->bindValue(':pseudo', safeInput($_POST['pseudo']), PDO::PARAM_STR);
            $stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);

            // Exécuter la requête
            if ($stmt->execute()) {
                $_SESSION['user_pseudo'] = safeInput($_POST['pseudo']);
            }

            // EDITER LA PHOTO DE PROFIL //

            // 1 - nous allons créer un nouveau non à notre image pour éviter les noms en doublon :
            $pic_name = uniqid() . '_' . basename($_FILES["pfp"]["name"]);

            // 2 - on stock notre requête de creation d'image avec des marqueurs nominatifs
            $sql = "UPDATE `76_users` 
                SET `user_avatar` = :avatar
                WHERE `user_id` = :user_id";

            // 3 - on prépare la requête avant de l'exécuter
            $stmt = $pdo->prepare($sql);

            // on lie nos valeurs
            $stmt->bindValue(':avatar', $pic_name, PDO::PARAM_STR);
            $stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);

            // 4 - si nous arrivons à executer la requête, on va charger la photo dans le dossier de l'utilisateur
            if ($stmt->execute()) {
                // nous allons cibler le repertoire image de l'utilisateur
                $user_directory = '../../assets/img/users/' . $_SESSION['user_id'] . '/';

                // on va enregistrer notre image avec le même nom que celle dans notre bdd
                move_uploaded_file($_FILES["pfp"]["tmp_name"], $user_directory . $pic_name);
                $_SESSION['user_avatar'] = $pic_name;
                // header('Location: controller-profile.php');
                // exit;
            }
        }

        var_dump($_SESSION);

        $pdo = '';
    }
}

include_once '../View/view-editprofile.php';
