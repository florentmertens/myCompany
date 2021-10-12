<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once __DIR__ . "/../model/EmployeeManager.php";
require_once __DIR__ . "/../classes/Employee.php";
require_once __DIR__ . "/../model/ServiceManager.php";
require_once __DIR__ . "/../classes/Service.php";
require_once __DIR__ . "/../model/UserManager.php";
require_once __DIR__ . "/../classes/User.php";

// Title of current page
$title = "Employés";

// Import header
require_once __DIR__ . "/../view/header.php";

// Instantiation of classes
$employeeManager = new EmployeeManager();
$serviceManager = new ServiceManager();
$userManager = new UserManager();

// Checks if user is logged in
if (isset($_SESSION["idUser"])) {
    $allEmployees = $employeeManager->getAllEmployees();
    // Checks if user made a action
    if (isset($_GET["action"])) {
        // Checks if user can do this action
        if ($_SESSION["role"] == "admin" || $_SESSION["role"] == "manager" || $_SESSION["role"] == "admin manager") {

            $allServices = $serviceManager->getAllService();
            $allManagers = $employeeManager->getAllManager();
            // Action add employee
            if ($_GET["action"] == "add") {
                $titleForm = "Ajout d'un employé";
                // Checks if form is empty
                if (empty($_POST)) {
                    // Value of action in the form tag
                    $action = "add";
                    // Import form employee
                    require_once __DIR__ . "/../view/employeeForm.php";

                    // Checks if all fields are complete
                } elseif (isset($_POST["lastName"]) && isset($_POST["firstName"]) && isset($_POST["dateBirth"]) && isset($_POST["job"]) && isset($_POST["hiringDate"]) && isset($_POST["salary"]) && isset($_POST["role"]) && isset($_POST["noService"]) && isset($_POST["email"])) {
                    // Converted tags to prevent XSS attacks
                    $lastName = htmlspecialchars($_POST["lastName"]);
                    $firstName = htmlspecialchars($_POST["firstName"]);
                    $dateBirth = new DateTime(htmlspecialchars($_POST["dateBirth"]));
                    $newdateBirth = $dateBirth->format("d-m-Y");
                    $job = htmlspecialchars($_POST["job"]);
                    $hiringDate = new DateTime(htmlspecialchars($_POST["hiringDate"]));
                    $newHiringDate = $hiringDate->format("d-m-Y");
                    $salary = (float) htmlspecialchars($_POST["salary"]);
                    $role = htmlspecialchars($_POST["role"]);
                    $noService = (int) htmlspecialchars($_POST["noService"]);
                    $email = htmlspecialchars($_POST["email"]);

                    // Checks if employee already exists
                    $lastNameEmployee = $employeeManager->getEmployeeByLastName($lastName);
                    if (!empty($lastNameEmployee)) {
                        foreach ($lastNameEmployee as $key => $value) {
                            if ($value->getLastName() == $lastName && $value->getFirstName() == $firstName && $value->getDateBirth() == $newdateBirth) {
                                $action = "add";
                                $error = "L'employé que vous nous avez fourni est déjà enregistré dans la base de donnée.";
                                require_once __DIR__ . "/../view/employeeForm.php";
                                die;
                            }
                        }
                    }

                    // Add manager according to the selected service
                    if ($role != "manager" || $role != "admin manager") {
                        foreach ($allManagers as $key => $value) {
                            if ($noService == $value->getNoService()) {
                                $noManager = $value->getNoEmployee();
                            }
                        }
                        if (!isset($noManager)) {
                            $noManager = 1;
                        }
                    } else {
                        $noManager = null;
                    }

                    // Add new employee in the database
                    $newEmployee = new Employee($lastName, $firstName, $newdateBirth, $job, $noManager, $newHiringDate, $salary, $role, $noService);
                    $employeeManager->createEmployee($newEmployee);
                    $employee = $employeeManager->getEmployeeByLastName($lastName);

                    // Create user account for new employee
                    foreach ($employee as $key => $value) {
                        if ($value->getLastName() == $lastName && $value->getFirstName() == $firstName && $value->getDateBirth() == $newdateBirth) {
                            $pseudo = $lastName . "." . $firstName;
                            $password = str_replace("-", "", $newdateBirth);
                            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                            $newUser = new User($pseudo, $email, $passwordHash, $value->getNoEmployee());
                            $userManager = $userManager->createUser($newUser);

                            $action = "addSuccess";
                            require_once __DIR__ . "/../view/employeeAlert.php";
                        }
                    }
                } else {
                    $action = "add";
                    $error = "Formulaire invalide. Merci de vérifier que tous les champs sont bien remplis.";
                    require_once __DIR__ . "/../view/employeeForm.php";
                }
                // Action update employee
            } elseif ($_GET["action"] == "update" && isset($_GET["id"])) {
                $titleForm = "Modification d'un employé";
                // Converted tags to prevent XSS attacks
                $id = (int) htmlspecialchars($_GET["id"]);

                $employee = $employeeManager->getEmployeeById($id);

                // Checks if employee exists
                if (!empty($employee)) {
                    // Checks if current user can update employee
                    if ($_SESSION["role"] == "admin"  || $_SESSION["role"] == "admin manager" || $_SESSION["role"] == "manager" && $_SESSION["noService"] == $employee->getNoService()) {
                        // Checks if form is empty
                        if (empty($_POST)) {
                            $action = "update";
                            $dateBirth = new DateTime($employee->getDateBirth());
                            $hiringDate = new DateTime($employee->getHiringDate());
                            // Import form employee
                            require_once __DIR__ . "/../view/employeeForm.php";
                        } else if (
                            isset($_POST["lastName"])
                            && isset($_POST["firstName"])
                            && isset($_POST["dateBirth"])
                            && isset($_POST["job"])
                            && isset($_POST["hiringDate"])
                            && isset($_POST["salary"])
                            && isset($_POST["role"])
                            && isset($_POST["noService"])
                        ) {
                            // Converted tags to prevent XSS attacks
                            $lastName = htmlspecialchars($_POST["lastName"]);
                            $firstName = htmlspecialchars($_POST["firstName"]);
                            $dateBirth = new DateTime(htmlspecialchars($_POST["dateBirth"]));
                            $newdateBirth = $dateBirth->format("d-m-Y");
                            $job = htmlspecialchars($_POST["job"]);
                            $hiringDate = new DateTime(htmlspecialchars($_POST["hiringDate"]));
                            $newHiringDate = $hiringDate->format("d-m-Y");
                            $salary = (float) htmlspecialchars($_POST["salary"]);
                            $role = htmlspecialchars($_POST["role"]);
                            $noService = (int) htmlspecialchars($_POST["noService"]);

                            // Add manager according to the selected service
                            if ($role == "manager") {
                                foreach ($allManagers as $key => $value) {
                                    if ($value->getNoManager() == null) {
                                        $noManager = $value->getNoEmployee();
                                    }
                                }
                            } elseif ($role == "employee") {
                                foreach ($allManagers as $key => $value) {
                                    if ($noService == $value->getNoService()) {
                                        $noManager = $value->getNoEmployee();
                                    }
                                }
                                if (!isset($noManager)) {
                                    $noManager = 1;
                                }
                            } else {
                                $noManager = null;
                            }

                            // Update employee in the database
                            $employeeUpdate = new Employee($lastName, $firstName, $newdateBirth, $job, $noManager, $newHiringDate, $salary, $role, $noService);
                            $employeeUpdate->setNoEmployee($employee->getNoEmployee());
                            $employeeManager->updateEmployee($employeeUpdate);

                            $action = "updateSuccess";
                            require_once __DIR__ . "/../view/employeeAlert.php";
                        } else {
                            $action = "update";
                            $error = "Formulaire invalide. Merci de vérifier que tous les champs sont bien remplis.";
                            require_once __DIR__ . "/../view/employeeForm.php";
                        }
                    } else {
                        $action = "accessDenied";
                        require_once __DIR__ . "/../view/employeeAlert.php";
                    }
                } else {
                    $action = "employeeNotFound";
                    require_once __DIR__ . "/../view/employeeAlert.php";
                }
                // Action delete employee
            } else if ($_GET["action"] == "delete" && isset($_GET["id"])) {
                // Converted tags to prevent XSS attacks
                $id = (int) htmlspecialchars($_GET["id"]);
                $employeeToDelete = $employeeManager->getEmployeeById($id);
                // Checks if employee exists
                if (!empty($employeeToDelete)) {
                    // Checks if current user can delete employee
                    if ($_SESSION["role"] == "admin" || $_SESSION["role"] == "admin manager" || $_SESSION["role"] == "manager" && $_SESSION["noService"] == $employeeToDelete->getNoService()) {
                        if ($employeeToDelete->getRole() == "manager" || $employeeToDelete->getRole() == "admin manager") {
                            $arrayEmployees = $employeeManager->getEmployeeByService($employeeToDelete->getNoService());
                            $newNoManager = 0;
                            foreach ($arrayEmployees as $employee) {
                                if (($employee->getRole() == "manager" || $employee->getRole() == "admin manager") && $employee->getNoEmployee() != $employeeToDelete->getNoEmployee()) {
                                    $newNoManager = $employee->getNoEmployee();
                                    break;
                                }
                            }
                            $employeeManager->updateNoManagerByServiceAndManager($newNoManager, $employeeToDelete->getNoService(), $employeeToDelete->getNoEmployee());
                        }

                        // Delete employee and user in the database
                        $userManager->deleteUserByNoEmployee($employeeToDelete->getNoEmployee());
                        $employeeManager->deleteEmployee($id);
                        $action = "deleteSuccess";
                        require_once __DIR__ . "/../view/employeeAlert.php";
                    } else {
                        $action = "accessDenied";
                        require_once __DIR__ . "/../view/employeeAlert.php";
                    }
                } else {
                    $action = "EmployeeNotFound";
                    require_once __DIR__ . "/../view/employeeAlert.php";
                }
                // Unknown action
            } else {
                header('Location: employeeController.php');
            }
        } else {
            $action = "accessDenied";
            require_once __DIR__ . "/../view/employeeAlert.php";
        }
    } else {
        require_once __DIR__ . "/../view/tableEmployee.php";
    }
} else {
    header('Location: homeController.php');
}

// Import footer
require_once __DIR__ . "/../view/footer.php";
