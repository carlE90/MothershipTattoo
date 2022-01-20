<?php

require "admin/admin.php";

class AdminController
{
    private $admin;

    public function __construct()
    {
        $this->admin = new Admin();
    }

    //LOGIN AS ADMIN
    public function connectAdmin()
    {
        $template = "views/admin/loginAdmin";
        if (!empty($_POST)) {
            $email = htmlspecialchars($_POST["email"]);
            $password = htmlspecialchars($_POST["password"]);
            $adminConfirm = $this->admin->getAdminByEmail($email);
            if (!$adminConfirm) {
                $message = "Votre email n'existe pas";
            } else {
                if (
                    password_verify($password, $adminConfirm["password"]) ==
                    true
                ) {
                    $_SESSION["admin"]["email"] = $email;
                    $_SESSION["admin"]["id"] = $adminConfirm["id_admin"];
                    $_SESSION["admin"]["pseudo"] = $adminConfirm["pseudo"];
                } else {
                    $message = "Password c'est pas correct";
                }
            }
        }
        $adminController = new AdminController();
        require "www/layoutAdmin.phtml";
    }

    // Confirm whether or not admin is connected
    public function is_admin()
    {
        if (isset($_SESSION["admin"])) {
            return true;
        } else {
            return false;
        }
    }

    public function disconnect()
    {
        session_start();
        session_destroy();
        header("Location:index.php");
    }
} // END OF CLASS AdminController
