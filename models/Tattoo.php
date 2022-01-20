<?php

class Tattoo
{
    protected $bdd;
    protected $database;

    public function __construct()
    {
        $this->database = new Database();
        $this->bdd = $this->database->getBDD();
    }
    // FUNCTION TO CONNECT PHOTO WITH TATTOO ARTIST

    public function getArtists()
    {
        $query = $this->bdd->prepare("SELECT
                                            `pseudo`,
                                            id_artist
                                        FROM
                                            `artist`");

        $query->execute();
        $artists = $query->fetchAll();
        return $artists;
    }

    // GET SPECIFIC TATTOO BY ITS ID
    public function getTattooById($id)
    {
        $query = $this->bdd->prepare("SELECT
                                            `id_tattoo`,
                                            `photo`,
                                            `id_artist`
                                        FROM
                                            `tattoo`
                                        WHERE
                                        `id_tattoo` = ?");
        $query->execute([$id]);
        $editTattoo = $qyert->fetch();
        return $editTattoo;
    }

    // ADD PHOTOS
    public function addTattoo($photo, $id)
    {
        $query = $this->bdd->prepare("INSERT INTO `tattoo`
                                        (`photo`, `id_artist`)
                                        VALUES(?,?)");
        $addTattoo = $query->execute([$photo, $id]);
        return $addTattoo;
    }

    // REMOVE PHOTOS

    public function removeTattoo($id)
    {
        $query = $this->bdd->prepare(
            "DELETE FROM `tattoo` WHERE `id_tattoo`=?"
        );

        //execution de la requête
        $removeTattoo = $query->execute([$id]);
        return $removeTattoo;
    }

    // SHOW TATTOS
    public function showTattoo()
    {
        $query = $this->bdd->prepare("SELECT
                                            artist.`id_artist`,
                                            `pseudo`,
                                            tattoo.photo,
                                            `id_tattoo`
                                        FROM
                                            `artist`
                                        INNER JOIN tattoo
                                        ON artist.id_artist=tattoo.id_artist");
        $query->execute();
        $showTattoo = $query->fetchAll();
        return $showTattoo;
    }
} // END OF CLASS TATTOO
