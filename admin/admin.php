<?php

class Admin{

    protected $bdd;
    protected $database;

    // construct to get BDD 
    public function __construct(){
        $this -> database = new Database();
        $this -> bdd = $this -> database -> getBDD();
    }

    // GET ADMIN DETAILS FROM BDD VIA EMAIL
    public function getAdminByEmail($email){
        $query = $this -> bdd -> prepare("SELECT
                                            `id_admin`,
                                            `email`,
                                            `password`,
                                            `pseudo`
                                        FROM
                                            `admin`
                                        WHERE email=?");

        $query -> execute([$email]);
        $admin = $query -> fetch();
        return $admin;
    }


}// END OF CLASS ADMIN

