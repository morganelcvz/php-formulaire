<?php 

class Voiture {

    // lancé à l'instanciation 
    function __construct() {
        echo "bonjour ";
    }

    // termine la fin d'une instanciation 
    function __destruct() {
        echo "votre saxo est prête"; 
    }

    public function klaxon(){
        echo "honk honk"; 
    }
}

// instanciation 
$saxo = new Voiture; 

<?php 

class Database {

    public $marque = "citroen";
    public $motorisation = "diesel";
    public $couleur = "grise";

    public function klaxon() {
        echo "pouet pouet";
    }

    public function rouler() {
        echo "la voiture roule";
    }
}

$saxo = new Voiture(); 
var_dump($saxo);


$saxo->motorisation; 
$saxo->rouler(); 

?> 