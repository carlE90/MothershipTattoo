<?php

class Database{
	
	private $bdd;
	// Constructor
	public function __construct(){
		try{
            // database for Mothership
			$this->bdd = new PDO ("mysql:host=db.3wa.io;dbname=carlelfving_mothership;charset=utf8", "carlelfving", "6308b9c40130e6c1624ca40a2742d485");
			}
            // IF error to get BDD show following message
			catch(Exception $erreur){
			    die("Erreur lors de la connexion à la base de données :" .$erreur->getMessage());
			}
	}
	// GETTER to get BDD
	public function getBDD(){
		return $this->bdd;
	}

}