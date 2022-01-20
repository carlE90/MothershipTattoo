<?php

// Start session
session_start();

// Database
require "connection/database.php";
require "controllers/AdminController.php";
require "controllers/ArticleController.php";
require "controllers/ArtistController.php";
require "controllers/TattooController.php";



// INSTANCING

$articleController = new ArticleController();
$adminController = new AdminController();
$artistController = new ArtistController();
$tattooController = new TattooController();




if(array_key_exists('action',$_GET)){
    switch($_GET['action']){
        // CONNECTION AS ADMIN
        case "connectAdmin":
            $adminController -> connectAdmin();  
            break;
        // DISCONNECT FROM SESSION AND DESTROY IT
        case "disconnect":
            $adminController -> disconnect();
            break;
        
        // ADD ARTICLES    
        case "addArticle":
            $articleController -> addArticle();  
            break;
        
        // EDIT ARTICLES
        case "editArticle":
            $articleController -> editArticle();
            break;
            
        // REMOVE ARTICLE
        case "removeArticle":
            $articleController -> removeArticle();
            break;
            
        // SHOW ARTIST
        case "showArtist":
            $artistController -> listArtist();
            break;
            
        // EDIT ARTIST
        case "editArtist":
            $artistController -> editArtist();
            break;
            
        // REMOVE ARTIST
        case "removeArtist":
            $artistController -> removeArtist();
            break;
        
        // ADD TATTOO ARTIST
        case "addArtist":
            $artistController -> addArtist();
            break;
            
        // ADD TATTOO
        case "addTattoo":
            $tattooController -> addTattoo();
            break;
            
        // EDIT TATTOO
        
         case "editTattoo":
            $tattooController -> removeTattoo();
            break;
            
        // EDIT TATTOO
        
         case "removeTattoo":
            $tattooController -> removeTattoo();
            break;
        
        // SHOW TATTOOS
        case "showTattoo":
            $tattooController -> showTattoo();
            break;

    }
}

else{
    $articleController -> listArticles();
}









?>