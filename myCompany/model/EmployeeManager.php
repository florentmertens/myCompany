<?php
require_once __DIR__ . "/../model/ConnectDb.php";
require_once __DIR__ . "/../classes/Employee.php";


class EmployeeManager extends ConnectDb
{
    public function getAllEmployees()
    {
        $arrayEmployees = [];
        try {
            $db = $this->connect();
            $req = $db->query("SELECT * FROM employee");
            while ($data = $req->fetch()) {
                $employee = new Employee($data["last_name"], $data["first_name"], $data["date_birth"], $data["job"], (int) $data["no_manager"], $data["hiring_date"], (float) $data["salary"], $data["role"], (int) $data["no_service"]);
                $employee->setNoEmployee((int) $data["no_employee"]);
                array_push($arrayEmployees, $employee);
            }
            return $arrayEmployees;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function getEmployeeById(int $noEmployee)
    {
        try {
            $db = $this->connect();
            $req = $db->prepare("SELECT * FROM employee WHERE no_employee = :noEmployee");
            $req->bindParam("noEmployee", $noEmployee);
            $req->execute();
            $data = $req->fetch();
            if (!empty($data)) {
                $employee = new Employee($data["last_name"], $data["first_name"], $data["date_birth"], $data["job"], (int) $data["no_manager"], $data["hiring_date"], (float) $data["salary"], $data["role"], (int) $data["no_service"]);
                $employee->setNoEmployee((int) $data["no_employee"]);
                return $employee;
            } else {
                return $data;
            }
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function createEmployee(object $employee)
    {
        $lastName = (string) $employee->getLastName();
        $firstName = (string) $employee->getFirstName();
        $dateBirth = (string) $employee->getDateBirth();
        $job = (string) $employee->getJob();
        $noManager =  $employee->getNoManager();
        $hiringDate = (string) $employee->getHiringDate();
        $salary = (float) $employee->getSalary();
        $role = (string) $employee->getRole();
        $noService = (int) $employee->getNoService();

        try {
            $db = $this->connect();
            $req = $db->prepare("INSERT INTO employee VALUES(null, :lastName, :firstName, :dateBirth, :job, :noManager, :hiringDate, :salary, :role, :noService)");
            $req->bindParam(":lastName", $lastName);
            $req->bindParam(":firstName", $firstName);
            $req->bindParam(":dateBirth", $dateBirth);
            $req->bindParam(":job", $job);
            $req->bindParam(":noManager", $noManager);
            $req->bindParam(":hiringDate", $hiringDate);
            $req->bindParam(":salary", $salary);
            $req->bindParam(":role", $role);
            $req->bindParam(":noService", $noService);
            $req->execute();
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function updateEmployee(object $employee)
    {
        $noEmployee = (int) $employee->getNoEmployee();
        $lastName = (string) $employee->getLastName();
        $firstName = (string) $employee->getFirstName();
        $dateBirth = (string) $employee->getDateBirth();
        $job = (string) $employee->getJob();
        $noManager = (int) $employee->getNoManager();
        $hiringDate = (string) $employee->getHiringDate();
        $salary = (float) $employee->getSalary();
        $role = (string) $employee->getRole();
        $noService = (int) $employee->getNoService();

        try {
            $db = $this->connect();
            $req = $db->prepare("UPDATE employee SET last_name = :lastName,
                                                    first_name = :firstName,
                                                    date_birth = :dateBirth,
                                                    job = :job,
                                                    no_manager = :noManager,
                                                    hiring_date = :hiringDate,
                                                    salary = :salary,
                                                    role = :role,
                                                    no_service = :noService
                                                    WHERE no_employee = :noEmployee");
            $req->bindParam(":lastName", $lastName);
            $req->bindParam(":firstName", $firstName);
            $req->bindParam(":dateBirth", $dateBirth);
            $req->bindParam(":job", $job);
            $req->bindParam(":noManager", $noManager);
            $req->bindParam(":hiringDate", $hiringDate);
            $req->bindParam(":salary", $salary);
            $req->bindParam(":role", $role);
            $req->bindParam(":noService", $noService);
            $req->bindParam(":noEmployee", $noEmployee);
            $req->execute();
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function getAllManager()
    {
        $arrayManagers = [];
        try {
            $db = $this->connect();
            $req = $db->query("SELECT * FROM employee WHERE role = 'manager' or role = 'admin manager'");
            while ($data = $req->fetch()) {
                $employee = new Employee($data["last_name"], $data["first_name"], $data["date_birth"], $data["job"], (int) $data["no_manager"], $data["hiring_date"], (float) $data["salary"], $data["role"], (int) $data["no_service"]);
                $employee->setNoEmployee((int) $data["no_employee"]);
                array_push($arrayManagers, $employee);
            }
            return $arrayManagers;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function getEmployeeByLastName(string $lastName)
    {
        $arrayEmployees = [];
        try {
            $db = $this->connect();
            $req = $db->prepare("SELECT * FROM employee WHERE last_name = :lastName");
            $req->bindParam("lastName", $lastName);
            $req->execute();
            while ($data = $req->fetch()) {
                $employee = new Employee($data["last_name"], $data["first_name"], $data["date_birth"], $data["job"], (int) $data["no_manager"], $data["hiring_date"], (float) $data["salary"], $data["role"], (int) $data["no_service"]);
                $employee->setNoEmployee((int) $data["no_employee"]);
                array_push($arrayEmployees, $employee);
            }
            return $arrayEmployees;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function deleteEmployee(int $id)
    {
        try {
            $db = $this->connect();
            $req = $db->prepare("DELETE FROM employee WHERE no_employee = :id");
            $req->bindParam("id", $id);
            $req->execute();
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function getEmployeeByService(int $noService)
    {
        try {
            $arrayEmployees = [];
            $db = $this->connect();
            $req = $db->prepare("SELECT * FROM employee WHERE no_service = :noService");
            $req->bindParam("noService", $noService);
            $req->execute();
            while ($data = $req->fetch()) {
                $employee = new Employee($data["last_name"], $data["first_name"], $data["date_birth"], $data["job"], (int) $data["no_manager"], $data["hiring_date"], (float) $data["salary"], $data["role"], (int) $data["no_service"]);
                $employee->setNoEmployee((int) $data["no_employee"]);
                array_push($arrayEmployees, $employee);
            }
            return $arrayEmployees;
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function updateNoManagerByServiceAndManager(int $noManager, int $noService, int $noEmployee)
    {
        try {
            $db = $this->connect();
            $req = $db->prepare("UPDATE employee SET no_manager = :noManager WHERE no_service = :noService AND no_manager = :noEmployee");
            $req->bindParam(":noManager", $noManager);
            $req->bindParam(":noService", $noService);
            $req->bindParam(":noEmployee", $noEmployee);
            $req->execute();
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
}
