<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once __DIR__ . "/../model/UserManager.php";
require_once __DIR__ . "/../classes/User.php";

$title = "Mon profil";
require_once __DIR__ . "/../view/header.php";

if (isset($_SESSION["idUser"])) {

    if (isset($_GET["action"]) && $_GET["action"] == "updateUserInfo") {
        try {
            $userManager = new UserManager();
            $data = $userManager->getUser((int) $_SESSION["idUser"]);

            if (empty($_POST)) {
                $action = "userInfo";
                require_once __DIR__ . "/../view/userForm.php";
            } else if (!empty($_POST["pseudo"]) && !empty($_POST["email"])) {
                $pseudo = htmlspecialchars($_POST["pseudo"]);
                $email = htmlspecialchars($_POST["email"]);

                $user = new User($pseudo, $email, $data->getPassword(), $data->getNoEmployee());
                $user->setIdUser((int) $data->getIdUser());
                $userManager->updateUser($user);
                $data = $userManager->getUser((int) $_SESSION["idUser"]);
                $_SESSION["pseudo"] = $data->getPseudo();
                $_SESSION["email"] = $data->getEmail();
                header('Location: userController.php');
            } else {
                echo "Veuillez remplir tous les champs.";
            }
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    } elseif (isset($_GET["action"]) && $_GET["action"] == "updatePassword") {
        try {
            $userManager = new UserManager();
            $data = $userManager->getUser((int) $_SESSION["idUser"]);

            if (empty($_POST)) {
                $action = "password";
                require_once __DIR__ . "/../view/userForm.php";
            } elseif (!empty($_POST["currentPassword"]) && !empty($_POST["newPassword"]) && !empty($_POST["confNewPassword"])) {
                $currentPassword = htmlspecialchars($_POST["currentPassword"]);
                $newPassword = htmlspecialchars($_POST["newPassword"]);
                $confNewPassword = htmlspecialchars($_POST["confNewPassword"]);

                if ($confNewPassword == $newPassword) {
                    if (password_verify($currentPassword, $data->getPassword())) {
                        $passwordHash = password_hash($newPassword, PASSWORD_DEFAULT);
                        $data->setPassword($passwordHash);
                        $userManager->updateUser($data);
                        header('Location: userController.php');
                    } else {
                        header('Location: userController.php?action=updatePassword&error=1');
                    }
                } else {
                    header('Location: userController.php?action=updatePassword&error=2');
                }
            } else {
                echo "Veuillez remplir tous les champs.";
            }
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    } else {
        require_once __DIR__ . "/../view/profil.php";
    }
    require_once __DIR__ . "/../view/footer.php";
} else {
    header('Location: homeController.php');
}
