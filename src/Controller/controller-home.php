<?php 

session_start();

if(!isset($_SESSION['user_id'])){
    header('Location: ../../public');
    exit;
}

?>


<?php include_once '../View/view-home.php' ?>

