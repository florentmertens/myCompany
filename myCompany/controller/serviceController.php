<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once __DIR__ . "/../model/ServiceManager.php";
require_once __DIR__ . "/../classes/Service.php";
require_once __DIR__ . "/../model/EmployeeManager.php";

// Title of current page
$title = "Services";

// Import header
require_once __DIR__ . "/../view/header.php";

// Instantiation of classes
$serviceManager = new ServiceManager();
$employeeManager = new EmployeeManager();

// Checks if user is logged in
if (isset($_SESSION["idUser"])) {
    $allServices = $serviceManager->getAllService();
    // Checks if user made a action
    if (isset($_GET["action"])) {
        // Checks if user can do this action
        if ($_SESSION["role"] == "admin" || $_SESSION["role"] == "admin manager") {
            // Action add service
            if ($_GET["action"] == "add") {
                $titleForm = "Ajout d'un service";
                // Checks if form is empty
                if (empty($_POST)) {
                    // Value of action in the form tag
                    $action = "add";
                    // Import form service
                    require_once __DIR__ . "/../view/serviceForm.php";
                } elseif (isset($_POST["name"]) && isset($_POST["city"])) {
                    // Converted tags to prevent XSS attacks
                    $name = htmlspecialchars($_POST["name"]);
                    $city = htmlspecialchars($_POST["city"]);

                    // Checks if employee already exists
                    foreach ($allServices as $key => $value) {
                        if ($value->getName() == $name && $value->getCity() == $city) {
                            $action = "add";
                            $error = "Le service que vous nous avez fourni est déja enregisté dans la base de donnée.";
                            require_once __DIR__ . "/../view/serviceForm.php";
                            die;
                        }
                    }

                    // Add new service in the database
                    $newService = new Service($name, $city);
                    $serviceManager->createService($newService);

                    $action = "addSuccess";
                    require_once __DIR__ . "/../view/serviceAlert.php";
                } else {
                    $action = "add";
                    $error = "Formulaire invalide. Merci de vérifier que tous les champs sont bien remplis.";
                    require_once __DIR__ . "/../view/serviceForm.php";
                }
            } elseif ($_GET["action"] == "update" && isset($_GET["id"])) {
                $titleForm = "Modification d'un service";

                // Converted tags to prevent XSS attacks
                $id = (int) htmlspecialchars($_GET["id"]);

                $service = $serviceManager->getServiceById($id);

                // Checks if service exists
                if (!empty($service)) {
                    // Checks if current user can update employee
                    if ($_SESSION["role"] == "admin"  || $_SESSION["role"] == "admin manager" || $_SESSION["role"] == "manager" && $_SESSION["noService"] == $employee->getNoService()) {
                        // Checks if form is empty
                        if (empty($_POST)) {
                            $action = "update";
                            // Import form service
                            require_once __DIR__ . "/../view/serviceForm.php";
                        } elseif (isset($_POST["name"]) && isset($_POST["city"])) {
                            // Converted tags to prevent XSS attacks
                            $name = htmlspecialchars($_POST["name"]);
                            $city = htmlspecialchars($_POST["city"]);

                            // Update service in the database
                            $serviceUpdate = new Service($name, $city);
                            $serviceUpdate->setNoService($service->getNoService());
                            $serviceManager->updateService($serviceUpdate);

                            $action = "updateSuccess";
                            require_once __DIR__ . "/../view/serviceAlert.php";
                        } else {
                            $action = "update";
                            $error = "Formulaire invalide. Merci de vérifier que tous les champs sont bien remplis.";
                            require_once __DIR__ . "/../view/serviceForm.php";
                        }
                    } else {
                        $action = "accessDenied";
                        require_once __DIR__ . "/../view/serviceAlert.php";
                    }
                } else {
                    $action = "serviceNotFound";
                    require_once __DIR__ . "/../view/serviceAlert.php";
                }
            } elseif ($_GET["action"] == "delete" && isset($_GET["id"])) {
                // Converted tags to prevent XSS attacks
                $id = (int) htmlspecialchars($_GET["id"]);
                $serviceToDelete = $serviceManager->getServiceById($id);
                // Checks if service exists
                if (!empty($serviceToDelete)) {
                    $employeeByService = $employeeManager->getEmployeeByService(($serviceToDelete->getNoService()));
                    // Changes noManager and noService of all employees in the service to be deleted
                    foreach ($employeeByService as $key => $value) {
                        $value->setNoManager(1);
                        $value->setNoService(1);
                        $result = $employeeManager->updateEmployee($value);
                    }

                    // Delete service in the database
                    $serviceManager->deleteService($id);
                    $action = "deleteSuccess";
                    require_once __DIR__ . "/../view/serviceAlert.php";
                } else {
                    $action = "ServiceNotFound";
                    require_once __DIR__ . "/../view/serviceAlert.php";
                }
                // Unknown action
            } else {
                header('Location: serviceController.php');
            }
        } else {
            $action = "accessDenied";
            require_once __DIR__ . "/../view/serviceAlert.php";
        }
    } else {
        require_once __DIR__ . "/../view/tableService.php";
    }
} else {
    header('Location: homeController.php');
}

// Import footer
require_once __DIR__ . "/../view/footer.php";
