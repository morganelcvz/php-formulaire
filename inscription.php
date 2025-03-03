<?php

// super globale $_GET 
// var_dump($_GET); 

// super globale $_POST 
var_dump($_POST);

//pas de chiffres
//pas de vide
//pas de caractère spéciaux

$errors = [];

//regex pour le formulaire 
$regex_name = "/^[a-zA-Z]+$/";

// NOM 
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    var_dump($_POST);
    if(isset($_POST['nom'])){
        if(empty($_POST['nom'])){
            $errors['nom'] = 'ce champ est obligatoire';
        } elseif (!preg_match($regex_name, $_POST['nom'])){
            $errors['nom'] = 'caractère non autorisé';
        }
    }
}

// PRENOM
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    var_dump($_POST);
    if(isset($_POST['prénom'])){
        if(empty($_POST['prénom'])){
            $errors['prénom'] = 'ce champ est obligatoire';
        } elseif (!preg_match($regex_name, $_POST['prénom'])){
            $errors['prénom'] = 'caractère non autorisé';
        }
    }
}

// E-MAIL
$regex_mail = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    var_dump($_POST);
    if(isset($_POST['email'])){
        if(empty($_POST['email'])){
            $errors['email'] = 'ce champ est obligatoire';
        } elseif (!preg_match($regex_mail, $_POST['email'])){
            $errors['email'] = 'e-mail non valide';
        }
    }
}

// MOT DE PASSE 
$regex_password = "/^\S+$/"; 

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    var_dump($_POST);
    if(isset($_POST['password'])){
        if(empty($_POST['password'])){
            $errors['password'] = 'ce champ est obligatoire';
        } elseif (!preg_match($regex_password, $_POST['password'])){
            $errors['password'] = 'caractère non autorisé';
        }
    }
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    var_dump($_POST);
    if(isset($_POST['password-confirm'])){
        if(empty($_POST['password-confirm'])){
            $errors['password-confirm'] = 'ce champ est obligatoire';
        } elseif (!preg_match($regex_password, $_POST['password-confirm'])){
            $errors['password-confirm'] = 'caractère non autorisé';
        } elseif ($_POST['password-confirm'] != $_POST['password']) {
            $errors['password-confirm'] = 'le mot de passe ne correspond pas';
        }
    }
}

// DATE DE NAISSANCE 
$regex_date = "/^(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[0-2])/\d{4}$/";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    var_dump($_POST);
    if(isset($_POST['dob'])){
        if(empty($_POST['dob'])){
            $errors['dob'] = 'ce champ est obligatoire';
        } elseif (!preg_match($regex_date, $_POST['dob'])){
            $errors['dob'] = 'date non valide';
        }
    }
}

// GENRE 

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    var_dump($_POST);
    if(isset($_POST['genre'])){
        if(empty($_POST['genre'])){
            $errors['genre'] = 'ce champ est obligatoire';
        } elseif (!preg_match($regex_genre, $_POST['genre'])){
            $errors['genre'] = 'date non valide';
        }
    }
}



var_dump($errors);

// //si mon tableau d'erreur est vide redirection
// if(empty($errors)) {
//     header('Location: confirmation.php');
//     exit;
// }

?> 

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire</title>
    <link href="/assets/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="main">
        <h2>Formulaire d'inscription</h2>
        <form method="post">
            <label for="nom">Nom</label>
            <span class="required"><?= $errors['nom'] ?? '' ?></span>
            <input type="text" id="nom" name="nom" value="<?= $_POST['nom'] ?? '' ?>">
            <br>
            <label for="prénom">Prénom</label>
            <span class="required"><?= $errors['prénom'] ?? '' ?></span>
            <input type="text" id="prénom" name="prénom" value="<?= $_POST['prénom'] ?? '' ?>">
            <br>
            <label for="email">E-mail</label>
            <span class="mail-error"><?= $errors['email'] ?? '' ?></span>
            <input type="email" id="email" name="email" value="<?= $_POST['email'] ?? '' ?>">
            <br>
            <label for="password">Mot de passe</label>
            <span class="mail-error"><?= $errors['password'] ?? '' ?></span>
            <input type="password" id="password" name="password">
            <br>
            <label for="password-confirm">Confirmation du mot de passe</label>
            <span class="mdp-error"><?= $errors['password-confirm'] ?? '' ?></span>
            <input type="password" id="password-confirm" name="password-confirm">
            <br>
            <label for="dob">Date de naissance</label>
            <span class="required"><?= $errors['dob'] ?? '' ?></span>
            <input type="date" id="dob" name="dob" value="<?= $_POST['dob'] ?? '' ?>">
            <br>
            <label for="genre">Genre</label>
            <span class="required"><?= $errors['genre'] ?? '' ?></span>
            <select name="genre" id="genre">
                <option value="vide"></option>
                <option value="homme">Homme</option>
                <option value="femme">Femme</option>
                <option value="autre">Autre</option>
            </select>
            <br>
            <div class="check">
                <input type="checkbox" id="conditions" name="conditions" value="conditions">
                <label for="conditions">accepter les conditions d'utilisation</label>
                <br/>
                <br/>
                <span class="accept">Veuillez accepter les conditions d'utilisation</span>
            </div>
            <div class="send">
                <button type="submit">envoyer</button>
            </div>
        </form>
    </div>
</body>

</html>