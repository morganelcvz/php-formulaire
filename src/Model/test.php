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
