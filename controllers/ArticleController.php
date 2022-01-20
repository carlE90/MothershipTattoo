<?php
require "models/Articles.php";

class ArticleController
{
    private $articles;
    private $artist;
    private $adminController;
    private $artistController;

    public function __construct()
    {
        $this->articles = new Articles();
        $this->adminController = new AdminController();
        $this->artistController = new artistController();
        $this->artist = new Artist();
    }

    // LIST CONTENT OF SITE ON FRONT PAGE
    public function listArticles()
    {
        $articles = $this->articles->getArticles();
        $artists = $this->artist->getArtists();
        $adminController = new AdminController();
        $template = "home";
        require "www/layout.phtml";
    }

    // ADDING ARTICLES

    public function addArticle()
    {
        if ($this->adminController->is_admin() == true) {
            $template = "views/articles/addArticle"; // ADD TEMPLATE TO ADD ARTICLES
            if (!empty($_POST)) {
                $title = htmlspecialchars($_POST["title"]);
                $content = htmlspecialchars($_POST["content"]);
                $photo = $_FILES["photo"]["name"];

                // UPLOAD PHOTO
                if (!empty($_FILES["photo"]["name"])) {
                    $tmp_name = $_FILES["photo"]["tmp_name"];
                    $name = $_FILES["photo"]["name"];
                    $uploads_dir = "www/images/articles";
                    move_uploaded_file($tmp_name, "$uploads_dir/$name");
                }

                $addArticle = $this->articles->addArticle(
                    $title,
                    $content,
                    $photo
                );
                if ($addArticle) {
                    $message = "L'article a bien été enregistré";
                } else {
                    $message = "Une erreur est survenue";
                }
                header(
                    "Location:index.php?action=editArticle&message=" . $message
                );
            }
            require "www/layoutAdmin.phtml";
        } else {
            // IF NOT SECURE SEND USER TO INDEX.PHP
            header("Location:index.php");
            exit();
        }
    }

    // EDIT EXISTING ARTICLES

    public function editArticle()
    {
        if ($this->adminController->is_admin() == true) {
            $template = "views/articles/editArticle";
            if (isset($_GET["id_article"])) {
                $article = $this->articles->getArticlesById(
                    $_GET["id_article"]
                );
                if (!empty($_POST)) {
                    $title = htmlspecialchars($_POST["title"]);
                    $content = htmlspecialchars($_POST["content"]);
                    $id = $_GET["id_article"];
                    $photo = $_FILES["photo"]["name"];

                    // UPLOAD PHOTO
                    if (!empty($_FILES["photo"]["name"])) {
                        $tmp_name = $_FILES["photo"]["tmp_name"];
                        $name = $_FILES["photo"]["name"];
                        $uploads_dir = "www/images/articles";
                        move_uploaded_file($tmp_name, "$uploads_dir/$name");

                        $updArticle = $this->articles->editArticle(
                            $title,
                            $content,
                            $photo,
                            $id
                        );
                    } else {
                        $updArticle = $this->articles->editArticleNoPhoto(
                            $title,
                            $content,
                            $id
                        );
                    }

                    if ($updArticle) {
                        $message = "Le produit a bien été modifié";
                    } else {
                        $message =
                            "Une erreur est survenue lors de la modification du produit";
                    }
                    header(
                        "Location:index.php?action=editArticle&message=" .
                            $message
                    );
                }
            } else {
                $articles = $this->articles->getArticles();
            }
            require "www/layoutAdmin.phtml";
        } else {
            // IF NOT SECURE SEND USER TO INDEX.PHP
            header("Location:index.php");
            exit();
        }
    }

    public function removeArticle()
    {
        if ($this->adminController->is_admin() == true) {
            $template = "views/articles/showArticle";
            if (isset($_GET["id_article"])) {
                $removeArticle = $this->articles->removeArticle(
                    $_GET["id_article"]
                );

                if ($removeArticle) {
                    $message = "L'Article a bien été supprimé";
                } else {
                    $message =
                        "Une erreur est survenue lors de la suppression du l'article";
                }
                header(
                    "Location:index.php?action=editArticle&message=" . $message
                );
            } else {
                $articles = $this->articles->getArticles();
            }
            require "www/layoutAdmin.phtml";
        } else {
            header("Location:index.php");
            exit();
        }
    }
} // END OF CLASS ARTICLECONTROLLER
