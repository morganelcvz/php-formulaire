<?php

class Comments
{

    public static function totalcomments($post_id)
    {
        // AFFICHAGE DES COMMENTAIRES TOTAL // 
        // connexion à la base de données via PDO (PHP Data Objects) = création instance
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

        // options activées sur notre instance
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // requete SQL me permettant de compter tous les commentaires d'un post
        $sql = "SELECT COUNT(*) AS total FROM 76_comments
        WHERE post_id = " . $post_id;

        // on prepare la requete pour se prémunir des injections SQL
        $stmt = $pdo->query($sql);

        // on stock le resultat de la requête dans un tableau associatif
        $comments = $stmt->fetch(PDO::FETCH_ASSOC);

        $pdo = '';

        return $comments['total'];
    }

    public static function deletecomment($com_id, $user_id)
    {
        // SUPPRIMER UN COMMENTAIRE // 
        // connexion à la base de données via PDO (PHP Data Objects) = création instance
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

        // options activées sur notre instance
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // requete SQL me permettant de supprimer un commentaire sur un post
        $sql = "DELETE FROM `76_comments` 
        WHERE `user_id` = :user_id AND `com_id` = :com_id";

        $stmt = $pdo->prepare($sql);

        // on bind la valeur du post 
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->bindValue(':com_id', $com_id, PDO::PARAM_STR);

        // on execute la requete 
        $stmt->execute();

        $pdo = '';
    }

    public static function editomment($com_id, $user_id)
    {

        // lancement des test lors d'un POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // var_dump($_SESSION);
            // var_dump($_POST);
            // var_dump($_FILES);

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
            }

            // var_dump($errors);

            if (empty($errors)) {

                // EDITER UN COMMENTAIRE // 
                // connexion à la base de données via PDO (PHP Data Objects) = création instance
                $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

                // options activées sur notre instance
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                //on stock notre requête de creation du post avec des marqueurs nominatifs
                $sql = "UPDATE `76_comments` 
                SET `com_text` = :comtext
                WHERE `user_id` = :user_id";

                // on prépare la requête avant de l'exécuter
                $stmt = $pdo->prepare($sql);

                // 
                $stmt->bindValue(':comtext', safeInput($_POST['comment']), PDO::PARAM_STR);
                $stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);

                // Exécuter la requête
                if ($stmt->execute()) {
                    $_SESSION['com_text'] = safeInput($_POST['comment']);
                    // header('Location: controller-profile.php');
                    // exit;
                }
            }
        }
    }
}
