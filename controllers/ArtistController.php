<?php

require "models/Artist.php";

class ArtistController
{
    private $artist;
    private $adminController;

    public function __construct()
    {
        $this->artist = new Artist();
        $this->adminController = new AdminController();
    }

    // LIST ARTISTS AS ADMIN
    public function listArtist()
    {
        if ($this->adminController->is_admin() == true) {
            $artists = $this->artist->getArtists();

            $template = "views/artist/showArtist";
            require "www/layoutAdmin.phtml";
        } else {
            header("Location:index.php");
            exit();
        }
    }

    // LIST ARTIST FOR FRONT PAGE
    public function whoAreWe()
    {
        $whoarewe = $this->artist->getArtists();
        $adminController = new AdminController();
    }

    //ADDING MORE ARTISTS

    public function addArtist()
    {
        if ($this->adminController->is_admin() == true) {
            $template = "views/artist/addArtist";
            if (!empty($_POST)) {
                $pseudo = htmlspecialchars($_POST["pseudo"]);
                $description = htmlspecialchars($_POST["description"]);
                $instagram = htmlspecialchars($_POST["instagram"]);
                $photo = $_FILES["photo"]["name"];

                // UPLOAD PHOTO
                if (!empty($_FILES["photo"]["name"])) {
                    $tmp_name = $_FILES["photo"]["tmp_name"];
                    $name = $_FILES["photo"]["name"];
                    $uploads_dir = "www/images/artist";
                    move_uploaded_file($tmp_name, "$uploads_dir/$name");
                }

                $addArtist = $this->artist->addArtist(
                    $pseudo,
                    $description,
                    $photo,
                    $instagram
                );

                if ($addArtist) {
                    $message = "L'Artiste a bien été enregistré";
                } else {
                    $message = "Une erreur est survenue";
                }
            }
            require "www/layoutAdmin.phtml";
        } else {
            // IF NOT SECURE SEND USER TO INDEX.PHP
            header("Location:index.php");
            exit();
        }
    }

    public function editArtist()
    {
        if ($this->adminController->is_admin() == true) {
            $template = "views/artist/editArtist";
            if (isset($_GET["id_artist"])) {
                $artist = $this->artist->getArtistById($_GET["id_artist"]);
                if (!empty($_POST)) {
                    $pseudo = htmlspecialchars($_POST["pseudo"]);
                    $description = htmlspecialchars($_POST["description"]);
                    $instagram = htmlspecialchars($_POST["instagram"]);
                    $id = $_GET["id_artist"];
                    $photo = $_FILES["photo"]["name"];

                    // UPLOAD PHOTO
                    if (!empty($_FILES["photo"]["name"])) {
                        $tmp_name = $_FILES["photo"]["tmp_name"];
                        $name = $_FILES["photo"]["name"];
                        $uploads_dir = "www/images/artist";
                        move_uploaded_file($tmp_name, "$uploads_dir/$name");

                        $updArtist = $this->artist->editArtist(
                            $id,
                            $pseudo,
                            $description,
                            $photo,
                            $instagram
                        );
                    } else {
                        $updArtist = $this->artist->editArtistNoPhoto(
                            $id,
                            $pseudo,
                            $description,
                            $instagram
                        );
                    }

                    if ($updArtist) {
                        $message = "L'Artiste a bien été modifié";
                    } else {
                        $message =
                            "Une erreur est survenue lors de la modification d'Artiste";
                    }
                    header(
                        "Location:index.php?action=showArtist&message=" .
                            $message
                    );
                }
            } else {
                $artist = $this->artist->getArtists();
            }
            require "www/layoutAdmin.phtml";
        } else {
            // IF NOT SECURE SEND USER TO INDEX.PHP
            header("Location:index.php");
            exit();
        }
    }

    // REMOVE ARTISTS
    public function removeArtist()
    {
        if ($this->adminController->is_admin() == true) {
            $template = "views/artist/showArtist";
            if (isset($_GET["id_artist"])) {
                $removeArtist = $this->artist->removeArtist($_GET["id_artist"]);

                if ($removeArtist) {
                    $message = "L'Artiste a bien été supprimé";
                } else {
                    $message =
                        "Une erreur est survenue lors de la suppression du l'artiste";
                }
                header(
                    "Location:index.php?action=showArtist&message=" . $message
                );
            } else {
                $artists = $this->artist->getArtists();
            }
            require "www/layoutAdmin.phtml";
        } else {
            header("Location:index.php");
            exit();
        }
    }
} //END OF CLASS artistCONTROLLER
