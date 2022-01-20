<?php

require "models/Tattoo.php";

class TattooController
{
    private $tattoo;
    private $adminController;
    private $artistController;

    public function __construct()
    {
        $this->tattoo = new Tattoo();
        $this->adminController = new AdminController();
        $this->artistController = new ArtistController();
    }

    public function addTattoo()
    {
        if ($this->adminController->is_admin() == true) {
            $template = "views/tattoo/addTattoo"; // ADD TEMPLATE TO ADD ARTICLES
            if (!empty($_FILES)) {
                $photo = $_FILES["photo"]["name"];
                $id = $_POST["id_artist"];
                //var_dump($photo);
                $uploads_dir = "www/images/tattoos";

                // UPLOAD PHOTO
                if (!empty($_FILES["photo"]["name"])) {
                    $tmp_name = $_FILES["photo"]["tmp_name"];
                    $name = $_FILES["photo"]["name"];
                    move_uploaded_file($tmp_name, "$uploads_dir/$name");
                }

                $addTattoo = $this->tattoo->addTattoo($photo, $id);
                if ($addTattoo) {
                    $message = "L'image a bien été enregistré";
                } else {
                    $message = "Une erreur est survenue";
                }
                header(
                    "Location:index.php?action=editTattoo&message=" . $message
                );
            } else {
                $users = $this->tattoo->getArtists();
            }
            require "www/layoutAdmin.phtml";
        } else {
            // IF NOT SECURE SEND USER TO INDEX.PHP
            header("Location:index.php");
            exit();
        }
    }

    public function removeTattoo()
    {
        if ($this->adminController->is_admin() == true) {
            $template = "views/tattoo/editTattoos";
            if (isset($_GET["id_tattoo"])) {
                $removeTattoo = $this->tattoo->removeTattoo($_GET["id_tattoo"]);

                if ($removeTattoo) {
                    $message = "Le Tattoo a bien été supprimé";
                } else {
                    $message =
                        "Une erreur est survenue lors de la suppression du l'article";
                }
                header(
                    "Location:index.php?action=editTattoo&message=" . $message
                );
            } else {
                $tattoos = $this->tattoo->showTattoo();
            }
            require "www/layoutAdmin.phtml";
        } else {
            header("Location:index.php");
            exit();
        }
    }

    public function showTattoo()
    {
        $tattoos = $this->tattoo->showTattoo();
        $artists = $this->tattoo->getArtists();

        $adminController = new AdminController();
        $template = "views/tattoo/showTattoos";
        require "www/layout.phtml";
    }
} //END OF CLASS USERCONTROLLER
