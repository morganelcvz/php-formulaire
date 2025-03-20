<?php

class Users
{

    public static function checkPseudoExist($pseudo)
    {
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
    }
}
