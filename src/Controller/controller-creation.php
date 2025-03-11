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

    if ($_FILES['photo']['error'] == 4) {
        $errors['photo'] = 'Veuillez sélecttionner une photo';
    }

    if (empty($_POST['description'])) {
        $errors['description'] = 'Veuillez saisir un commentaire';
    }

    // var_dump($errors);

    if (empty($errors)) {

        // connexion à la base de données via PDO (PHP Data Objects) = création instance
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

        // options activées sur notre instance
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //on stock notre requête de creation du post avec des marqueurs nominatifs
        $sql = "INSERT INTO `76_posts` (`post_timestamp`, `post_description`, `post_private`, `user_id`) VALUES
            (:timestamp, :description, :private, :user_id);";

        // on prépare la requête avant de l'exécuter
        $stmt = $pdo->prepare($sql);

        // fonction permettant de nettoyer les inputs
        function safeInput($string)
        {
            $input = trim($string);
            $input = htmlspecialchars($input);
            return $input;
        }

        // on utiliser la fonction time() pour récupérer le timestamp à l'instant t
        $stmt->bindValue(':timestamp', time(), PDO::PARAM_INT);
        $stmt->bindValue(':description', safeInput($_POST['description']), PDO::PARAM_STR);
        // nous mettons le private à 0
        $stmt->bindValue(':private', 0, PDO::PARAM_INT);
        $stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);

        // nous executons la requête pour créer le post
        $stmt->execute();

        // le post étant créé, nous allons récupérer son ID à l'aide de la méthode lastInsertId
        $post_id = $pdo->lastInsertId();


        // Maintenant nous allons sauvegarder l'image dans le repertoire de l'utilisateur

        // 1 - nous allons créer un nouveau non à notre image pour éviter les noms en doublon :
        $pic_name = uniqid() . '_' . basename($_FILES["photo"]["name"]);


        // 2 - on stock notre requête de creation d'image avec des marqueurs nominatifs
        $sql = "INSERT INTO `76_pictures` (`pic_name`, `post_id`) VALUES (:pic_name, :post_id);";

        // 3 - on prépare la requête avant de l'exécuter
        $stmt = $pdo->prepare($sql);

        // on lie nos valeurs
        $stmt->bindValue(':pic_name', $pic_name, PDO::PARAM_STR);
        $stmt->bindValue(':post_id', $post_id, PDO::PARAM_INT);

        // 4 - si nous arrivons à executer la requête, on va charger la photo dans le dossier de l'utilisateur
        if ($stmt->execute()) {
            // nous allons cibler le repertoire image de l'utilisateur
            $user_directory = '../../assets/img/users/' . $_SESSION['user_id'] . '/';

            // on va enregistrer notre image avec le même nom que celle dans notre bdd
            move_uploaded_file($_FILES["photo"]["tmp_name"], $user_directory . $pic_name);

            header('Location: controller-profile.php'); 
            exit;
        }

        $pdo = '';
    }
}

// inclus la view
include_once '../View/view-creation.php';

?>