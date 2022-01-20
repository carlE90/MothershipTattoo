<?php
session_start();
 if(isset($_SESSION['admin'])){
	
	
// connexion à la base de données
require "../connection/database.php";
//créer une instance de cette classe 
$bdd = new Database(); // WITH CLASS USE INSTANCE

// Create an admin manually

$pseudo = "admin";
$email = "admin@live61.com";
$mdp = password_hash("live61", PASSWORD_DEFAULT);


//  getBDD FROM BDD FILE database.php function getBDD()
$query = $bdd -> getBDD() -> prepare("INSERT INTO `admin`(
						    `pseudo`,
						    `email`,
						    `password`)
							VALUES(?,?,?)");
$query -> execute([$pseudo,$email,$mdp]);




 }
 else{
 	header('Location:../index.php');
 	exit();
 }

?>