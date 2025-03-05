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
$regex_name = "/^[A-Za-zÀ-ÖØ-öø-ÿ]+$/";

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


// se connecter à la DDB via PDO (PHP DATA OBJECT) = création d'instance
$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS); 

// options activées sur notre instance
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

$sql = "SELECT * FROM `76_users` WHERE `user_pseudo` = :pseudo";

// on prépare la requête pour se prémunir des injections sql 
$stmt = $pdo->prepare($sql);

// on bind la valeur du post 
$stmt->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR); 

// on execute la requete 
$stmt->execute(); 

// on compte les résultats, on crée une variable $found qui sera un booleen 
$stmt->rowCount() == 0 ? $found = false : $found = true; 

// on détruit notre instance 
$pdo = ''; 


// PSEUDO 

$regex_pseudo = "/^[a-zA-Z0-9_-]+$/";

if (isset($_POST['pseudo'])) {
    if (empty($_POST['pseudo'])) {
        $errors['pseudo'] = 'ce champ est obligatoire';
    } elseif (!preg_match($regex_name, $_POST['pseudo'])) {
        $errors['pseudo'] = 'caractère non autorisé';
    } elseif ($found == true){ 
        $errors['pseudo'] = 'ce pseudo est déjà utilisé';
    }
}

// se connecter à la DDB via PDO (PHP DATA OBJECT) = création d'instance
$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS); 

// options activées sur notre instance
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

$sql = "SELECT * FROM `76_users` WHERE `user_mail` = :mail";

// on prépare la requête pour se prémunir des injections sql 
$stmt = $pdo->prepare($sql);

// on bind la valeur du post 
$stmt->bindValue(':mail', $_POST['email'], PDO::PARAM_STR); 

// on execute la requete 
$stmt->execute(); 

// on compte les résultats, on crée une variable $found qui sera un booleen 
$stmt->rowCount() == 0 ? $found = false : $found = true; 

// on détruit notre instance 
$pdo = ''; 

// E-MAIL
$regex_mail = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

    if (isset($_POST['email'])) {
        if (empty($_POST['email'])) {
            $errors['email'] = 'ce champ est obligatoire';
        } elseif (!preg_match($regex_mail, $_POST['email'])) {
            $errors['email'] = 'e-mail non valide';
        } elseif ($found == true) {
            $errors['email'] = 'cet email est déjà utilisé';
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
        // se connecter à la DDB via PDO (PHP DATA OBJECT) = création d'instance
            $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS); 
            // options activées sur notre instance
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

            // requête stockée avec des marqueurs nominatifs 
            $sql = "INSERT INTO 
            76_users(
            user_gender, 
            user_lastname, 
            user_firstname, 
            user_pseudo, 
            user_birthdate, 
            user_mail, 
            user_password
            )
            VALUES (
            :gender,
            :lastname,
            :firstname,
            :pseudo,
            :birthdate,
            :mail,
            :password
            )"; 

            //on prépare la requête 
            $stmt = $pdo->prepare($sql);

            function safeInput($string){
                $input = trim($string);
                $input = htmlspecialchars($input);
                return $input;
            }

            $stmt->bindValue(':gender', safeInput($_POST['genre']), PDO::PARAM_STR);
            $stmt->bindValue(':lastname', safeInput($_POST['nom']), PDO::PARAM_STR);
            $stmt->bindValue(':firstname', safeInput($_POST['prénom']), PDO::PARAM_STR);
            $stmt->bindValue(':pseudo', safeInput($_POST['pseudo']), PDO::PARAM_STR);
            $stmt->bindValue(':birthdate', safeInput($_POST['dob']), PDO::PARAM_STR);
            $stmt->bindValue(':mail', safeInput($_POST['email']), PDO::PARAM_STR);
            $stmt->bindValue(':password', password_hash($_POST['password'], PASSWORD_DEFAULT),PDO::PARAM_STR); 

            
        if ($stmt->execute()){
        header('Location: controller-confirmation.php'); 
        exit;
        }

        // on supprime l'instance pdo 

        $pdo = '';
    }
}

// var_dump($pdo);
// var_dump($_POST);
// var_dump($errors);

include_once '../view/view-inscription.php'; 

?>