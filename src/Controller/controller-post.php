<?php

session_start();

require_once '../../config.php';

// on controle si la personne est bien loggée
if (!isset($_SESSION['user_id'])) {
    // on renvoie vers la page d'accueil si non
    header('Location: ../../public/');
    exit;
}

$errors = [];

// BOUCLE DES COMMENTAIRES //
// connexion à la base de données via PDO (PHP Data Objects) = création instance
$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

// options activées sur notre instance
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// requete SQL me permettant d'afficher tous les commentaires sur un post
$sql = "SELECT * FROM `76_posts`
INNER JOIN `76_comments`
ON 76_comments.post_id = 76_posts.post_id
INNER JOIN `76_users` 
ON 76_users.user_id = 76_comments.user_id 
INNER JOIN `76_pictures` 
ON 76_pictures.post_id = 76_posts.post_id
WHERE 76_posts.post_id = " . $_GET['post'];

// on prepare la requete pour se prémunir des injections SQL
$stmt = $pdo->query($sql);

// on stock le resultat de la requête dans un tableau associatif
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

$pdo = '';


// INFORMATION D'UN POST SELON SON ID //
// connexion à la base de données via PDO (PHP Data Objects) = création instance
$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

// options activées sur notre instance
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// requete SQL me permettant d'afficher les informations d'un post
$sql = "SELECT * FROM `76_posts`
INNER JOIN `76_users` 
ON 76_users.user_id = 76_posts.user_id 
INNER JOIN `76_pictures` 
ON 76_pictures.post_id = 76_posts.post_id
WHERE 76_posts.post_id = " . $_GET['post'];

// on prepare la requete pour se prémunir des injections SQL
$stmt = $pdo->query($sql);

// on stock le resultat de la requête dans un tableau associatif
$post = $stmt->fetch(PDO::FETCH_ASSOC);

$pdo = '';


// AFFICHAGE DES LIKES //
// connexion à la base de données via PDO (PHP Data Objects) = création instance
$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

// options activées sur notre instance
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// requete SQL me permettant de compter tous les likes sur un seul post
$sql = "SELECT COUNT(*) AS total FROM `76_likes`
INNER JOIN `76_posts` ON 76_likes.post_id = 76_posts.post_id 
WHERE 76_posts.post_id = " . $_GET['post'];

// on prepare la requete pour se prémunir des injections SQL
$stmt = $pdo->query($sql);

// on stock le resultat de la requête dans un tableau associatif
$likes = $stmt->fetch(PDO::FETCH_ASSOC);

$pdo = '';


// POSTER UN COMMENTAIRE //
//regex pour le commentaire
$regex_comment = "/^(?!\s*$)[\p{L}\p{N}\p{P}\p{S}\s\p{Emoji}]+$/";

// COMMENTAIRE
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['comment'])) {
        if (empty($_POST['comment'])) {
            $errors['comment'] = 'commentaire vide';
        } elseif (!preg_match($regex_comment, $_POST['comment'])) {
            $errors['comment'] = 'commentaire invalide';
        }
    }

    if (empty($errors)) {
        // se connecter à la DDB via PDO (PHP DATA OBJECT) = création d'instance
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
        // options activées sur notre instance
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // requête stockée avec des marqueurs nominatifs 
        $sql = "INSERT INTO 
            76_comments(
            com_text, 
            post_id, 
            user_id, 
            com_timestamp
            )
            VALUES (
            :comtext,
            :postid,
            :userid,
            :timestamp
            )";

        //on prépare la requête 
        $stmt = $pdo->prepare($sql);

        function safeInput($string)
        {
            $input = trim($string);
            $input = htmlspecialchars($input);
            return $input;
        }

        $stmt->bindValue(':comtext', safeInput($_POST['comment']), PDO::PARAM_STR);
        $stmt->bindValue(':postid', safeInput($_GET['post']), PDO::PARAM_STR);
        $stmt->bindValue(':userid', safeInput($_SESSION['user_id']), PDO::PARAM_STR);
        $stmt->bindValue(':timestamp', time(), PDO::PARAM_STR);

        // on supprime l'instance pdo 
        $pdo = '';

        if ($stmt->execute()){
            header('Location: controller-post.php?post='.$_GET['post']); 
            exit;
            }
        
    }
}


?>

<?php include_once '../View/view-post.php' ?>