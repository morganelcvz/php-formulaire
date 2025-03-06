<?php 

session_start();

if(isset($_SESSION['user_id'])){
    header('Location: controller-profile.php');
    exit;
}

?>

<?php include_once '../View/view-confirmation.php' ?>

