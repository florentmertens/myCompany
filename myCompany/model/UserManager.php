<?php
require_once __DIR__ . "/ConnectDb.php";
require_once __DIR__ . "/../classes/User.php";

class UserManager extends ConnectDb
{
    public function getAllUsers()
    {
        $arrayUsers = [];
        try {
            $db = $this->connect();
            $req = $db->query("SELECT * FROM user");
            while ($data = $req->fetch()) {
                $user = new User($data["pseudo"], $data["email"], $data["password"], (int) $data["no_employee"]);
                $user->setIdUser($data["id_user"]);
                array_push($arrayUsers, $user);
            }
            return $arrayUsers;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function getUser(int $idUser)
    {
        try {
            $db = $this->connect();
            $req = $db->prepare("SELECT * FROM user WHERE id_user = :idUser");
            $req->bindParam("idUser", $idUser);
            $req->execute();
            $data = $req->fetch();
            $user = new User($data["pseudo"], $data["email"], $data["password"], (int) $data["no_employee"]);
            $user->setIdUser((int) $data["id_user"]);
            return $user;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function createUser(object $user)
    {
        $pseudo = (string) $user->getPseudo();
        $email = (string) $user->getEmail();
        $password = (string) $user->getPassword();
        $noEmployee = (int) $user->getNoEmployee();

        try {
            $db = $this->connect();
            $req = $db->prepare("INSERT INTO user VALUES(null, :pseudo, :email, :password, :noEmployee)");
            $req->bindParam(":pseudo", $pseudo);
            $req->bindParam(":email", $email);
            $req->bindParam(":password", $password);
            $req->bindParam(":noEmployee", $noEmployee);
            $req->execute();
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function updateUser(object $user)
    {
        $pseudo = (string) $user->getPseudo();
        $email = (string) $user->getEmail();
        $password = (string) $user->getPassword();
        $noEmployee = (int) $user->getNoEmployee();
        $idUser = (int) $user->getIdUser();

        try {
            $db = $this->connect();
            $req = $db->prepare("UPDATE user SET pseudo = :pseudo,
                                                    email = :email,
                                                    password = :password,
                                                    no_employee = :noEmployee
                                                    WHERE id_user = :idUser");
            $req->bindParam(":pseudo", $pseudo);
            $req->bindParam(":email", $email);
            $req->bindParam(":password", $password);
            $req->bindParam(":noEmployee", $noEmployee);
            $req->bindParam(":idUser", $idUser);
            $req->execute();
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function getUserByPseudo(string $pseudo)
    {
        try {
            $db = $this->connect();
            $req = $db->prepare("SELECT * FROM user WHERE pseudo = :pseudo");
            $req->bindParam("pseudo", $pseudo);
            $req->execute();
            $data = $req->fetch();
            if (!empty($data)) {
                $user = new User($data["pseudo"], $data["email"], $data["password"], (int) $data["no_employee"]);
                $user->setIdUser((int) $data["id_user"]);
                return $user;
            } else {
                return $user = null;
            }
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function deleteUser(int $id)
    {
        try {
            $db = $this->connect();
            $req = $db->prepare("DELETE FROM user WHERE id_user = :id");
            $req->bindParam("id", $id);
            $req->execute();
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function deleteUserByNoEmployee(int $noEmployee)
    {
        try {
            $db = $this->connect();
            $req = $db->prepare("DELETE FROM user WHERE no_employee = :noEmployee");
            $req->bindParam("noEmployee", $noEmployee);
            $req->execute();
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
}
