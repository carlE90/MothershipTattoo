<?php

class Articles
{
    protected $bdd;
    protected $database;

    public function __construct()
    {
        $this->database = new Database();
        $this->bdd = $this->database->getBDD();
    }

    public function getArticles()
    {
        $query = $this->bdd->prepare("SELECT
                                        `id_article`,
                                        `title`,
                                        `content`,
                                        `photo`,
                                        `date`
                                    FROM
                                        `articles`");

        $query->execute();
        $articles = $query->fetchAll();
        return $articles;
    }

    public function getArticlesById($id)
    {
        $query = $this->bdd->prepare("SELECT
                                            `id_article`,
                                            `title`,
                                            `content`,
                                            `photo`
                                        FROM
                                            `articles`
                                        WHERE
                                        id_article = ?");
        $query->execute([$id]);
        $editArticles = $query->fetch();
        return $editArticles;
    }

    public function addArticle($title, $content, $photo)
    {
        $query = $this->bdd->prepare("INSERT INTO `articles`(
                                            `title`,
                                            `content`,
                                            `photo`,
                                            `date`)
                                        VALUES(?,?,?,NOW())");
        $addArticle = $query->execute([$title, $content, $photo]);
        return $addArticle;
    }

    public function editArticle($title, $content, $photo, $id)
    {
        $query = $this->bdd->prepare("UPDATE
                                                `articles`
                                            SET
                                                `title` = ?,
                                                `content` = ?,
                                                `photo` = ?
                                        WHERE id_article = ?");
        $editArticle = $query->execute([$title, $content, $photo, $id]);

        return $editArticle;
    }

    public function editArticleNoPhoto($title, $content, $id)
    {
        $query = $this->bdd->prepare("UPDATE
                                                `articles`
                                            SET
                                                `title` = ?,
                                                `content` = ?
                                        WHERE id_article = ?");
        $editArticle = $query->execute([$title, $content, $id]);

        return $editArticle;
    }

    public function removeArticle($id)
    {
        $query = $this->bdd->prepare(
            "DELETE FROM `articles` WHERE id_article = ?"
        );

        $removeArticle = $query->execute([$id]);
        return $removeArticle;
    }
} // END OF CLASS ARTICLES
