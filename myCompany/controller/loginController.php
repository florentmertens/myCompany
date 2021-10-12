<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once __DIR__ . "/../model/UserManager.php";
require_once __DIR__ . "/../model/EmployeeManager.php";
require_once __DIR__ . "/../classes/User.php";

// Title of current page
$title = "Connexion";

// Import header
require_once __DIR__ . "/../view/header.php";

// Checks if user made action connect
if (isset($_GET["action"]) && $_GET["action"] == "connect") {
    // Checks if all fields are complete
    if (isset($_POST["pseudo"]) && isset($_POST["password"])) {
        // Converted tags to prevent XSS attacks
        $pseudo = htmlentities($_POST["pseudo"]);
        $password = htmlspecialchars($_POST["password"]);

        $userManager = new UserManager();
        $data = $userManager->getUserByPseudo($pseudo);

        // Checks if user exists
        if (!empty($data)) {
            // Checks if password matches with the one stored in the database
            if (password_verify($password, $data->getPassword())) {
                $_SESSION["idUser"] = $data->getIdUser();
                $_SESSION["pseudo"] = $data->getPseudo();
                $_SESSION["email"] = $data->getEmail();
                $_SESSION["noEmployee"] = $data->getNoEmployee();
                $employeeManager = new EmployeeManager;
                $employee = $employeeManager->getEmployeeById($data->getNoEmployee());
                $_SESSION["lastName"] = $employee->getLastName();
                $_SESSION["firstName"] = $employee->getFirstName();
                $_SESSION["dateBirth"] = $employee->getDateBirth();
                $_SESSION["job"] = $employee->getJob();
                $_SESSION["noManager"] = $employee->getnoManager();
                $_SESSION["hiringDate"] = $employee->getHiringDate();
                $_SESSION["salary"] = $employee->getSalary();
                $_SESSION["role"] = $employee->getRole();
                $_SESSION["noService"] = $employee->getNoService();
                header('Location: homeController.php');
            } else {
                header('Location: loginController.php?error');
            }
        } else {
            header('Location: loginController.php?error');
        }
    }
} else {
    // Import form login
    require_once __DIR__ . "/../view/loginForm.php";
}
require_once __DIR__ . "/../view/footer.php";
