<?php

class Pictures
{

    public static function getPicname($post_id)
    {
        // connexion à la base de données via PDO (PHP Data Objects) = création instance
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

        // options activées sur notre instance
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT pic_name FROM 76_pictures WHERE post_id = :post_id";

        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(":post_id", $post_id, PDO::PARAM_INT);

        $stmt->execute();  

        $pdo = ""; 
        
        return $stmt->fetchColumn(); 

    }
}
