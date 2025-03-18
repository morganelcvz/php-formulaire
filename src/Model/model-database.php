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