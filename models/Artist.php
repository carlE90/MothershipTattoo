<?php

class Artist
{
    protected $bdd;
    protected $database;

    public function __construct()
    {
        $this->database = new Database();
        $this->bdd = $this->database->getBDD();
    }

    public function getArtists()
    {
        $query = $this->bdd->prepare("SELECT
									    `id_artist`,
									    `pseudo`,
									    `photo`,
									    `description`,
									    `instagram`
										FROM
										    `artist`");

        $query->execute();
        $artist = $query->fetchAll();
        return $artist;
    }

    public function getArtistById($id)
    {
        $query = $this->bdd->prepare("SELECT
										    `id_artist`,
										    `pseudo`,
										    `description`,
										    `photo`,
										    `instagram`
										FROM
										    `artist`
										WHERE id_artist = ?");
        $query->execute([$id]);
        $editArtist = $query->fetch();
        return $editArtist;
    }

    public function addArtist($pseudo, $description, $photo, $instagram)
    {
        $query = $this->bdd->prepare("INSERT INTO `artist`(
										    `pseudo`,
										    `description`,
										    `photo`,
										    `instagram`)
										VALUES(?,?,?,?)");

        $addartist = $query->execute([
            $pseudo,
            $description,
            $photo,
            $instagram,
        ]);
        return $addartist;
    }

    public function editArtist($id, $pseudo, $description, $photo, $instagram)
    {
        $query = $this->bdd->prepare("UPDATE
											    `artist`
											SET
											    `pseudo` = ?,
											    `description` = ?,
											    `photo` = ?,
											    `instagram` = ?
											WHERE id_artist = ?");
        $editArtist = $query->execute([
            $pseudo,
            $description,
            $photo,
            $instagram,
            $id,
        ]);

        return $editArtist;
    }

    public function editArtistNoPhoto($id, $pseudo, $description, $instagram)
    {
        $query = $this->bdd->prepare("UPDATE
											    `artist`
											SET
											    `pseudo` = ?,
											    `description` = ?,
											    `instagram` = ?
											WHERE id_artist = ?");
        $editArtist = $query->execute([$pseudo, $description, $instagram, $id]);

        return $editArtist;
    }

    public function removeArtist($id)
    {
        $query = $this->bdd->prepare(
            "DELETE FROM `artist` WHERE `id_artist`=?"
        );

        //execution de la requête
        $removeartist = $query->execute([$id]);
        return $removeartist;
    }
} //END OF CLASS artist
