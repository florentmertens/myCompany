<?php
require_once __DIR__ . "/../model/ConnectDb.php";
require_once __DIR__ . "/../classes/Service.php";

class ServiceManager extends ConnectDb
{
    public function getAllService()
    {
        $arrayServices = [];
        try {
            $db = $this->connect();
            $req = $db->query("SELECT * FROM service");
            while ($data = $req->fetch()) {
                $service = new Service($data["name"], $data["city"]);
                $service->setNoService((int) $data["no_service"]);
                array_push($arrayServices, $service);
            }
            return $arrayServices;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function getServiceById(int $noService)
    {
        try {
            $db = $this->connect();
            $req = $db->prepare("SELECT * FROM service WHERE no_service = :noService");
            $req->bindParam("noService", $noService);
            $req->execute();
            $data = $req->fetch();
            $service = new Service($data["name"], $data["city"]);
            $service->setNoService((int) $data["no_service"]);
            return $service;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function createService(object $service)
    {
        $name = (string) $service->getName();
        $city = (string) $service->getCity();

        try {
            $db = $this->connect();
            $req = $db->prepare("INSERT INTO service VALUES(null, :name, :city)");
            $req->bindParam(":name", $name);
            $req->bindParam(":city", $city);
            $req->execute();
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function updateService(object $service)
    {
        $name = (string) $service->getName();
        $city = (string) $service->getCity();
        $noService = (int) $service->getNoService();

        try {
            $db = $this->connect();
            $req = $db->prepare("UPDATE service SET name = :name,
                                                    city = :city
                                                    WHERE no_service = :noService");
            $req->bindParam(':name', $name);
            $req->bindParam(':city', $city);
            $req->bindParam(':noService', $noService);
            $req->execute();
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function deleteService(int $id)
    {
        try {
            $db = $this->connect();
            $req = $db->prepare("DELETE FROM service WHERE no_service = :id");
            $req->bindParam("id", $id);
            $req->execute();
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
}
