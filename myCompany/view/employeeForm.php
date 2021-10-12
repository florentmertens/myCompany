<div class="container d-flex flex-column justify-content-center align-items-center mt-5 text-center">
    <h1 class="mb-4"><?php echo $titleForm ?></h1>
    <form id="employeeForm" action="employeeController.php<?php echo isset($action) ? ($action == "add" ? "?action=add" : ($action == "update" ? "?action=update&id=" . $employee->getNoEmployee() : "")) : "" ?>" method="post" class="needs-validation mb-5" novalidate>
        <?php
        if (isset($error)) {
            echo '<div class="alert alert-danger" role="alert">
                    ' . $error . '
                </div>';
        }
        // Form add employee
        if (isset($action) && $action == "add") {
            echo '
        <div class="row mb-3">
            <div class="col-6 d-flex flex-column align-items-center">
                <label for="lastName" class="label mb-1">Nom</label>
                <input type="text" name="lastName" id="lastName" class="form-control text-center" required pattern="^[\S]+$">
                <div class="valid-feedback">
                    Champ rempli
                </div>
                <div class="invalid-feedback">
                    Les espaces ne sont pas autoriser. <br>
                    Veuillez remplir ce champ s\'il vous plaît.
                </div>
            </div>
            <div class="col-6 d-flex flex-column align-items-center">
                <label for="firstName" class="label mb-1">Prénom</label>
                <input type="text" name="firstName" id="firstName" class="form-control text-center" required pattern="^[\S]+$">
                <div class="valid-feedback">
                    Champ rempli
                </div>
                <div class="invalid-feedback">
                    Les espaces ne sont pas autoriser. <br>
                    Veuillez remplir ce champ s\'il vous plaît.
                </div>
            </div>
        </div>
        <div class="d-flex flex-column mb-3">
            <label for="dateBirth" class="label mb-1">Date de naissance</label>
            <input type="date" name="dateBirth" id="dateBirth" class="form-control text-center align-self-center w-50" required>
            <div class="valid-feedback">
                Champ rempli
            </div>
            <div class="invalid-feedback">
                Veuillez remplir ce champ s\'il vous plaît.
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-6 d-flex flex-column align-items-center">
                <label for="job" class="label mb-1">Poste</label>
                <input type="text" name="job" id="job" class="form-control text-center" required pattern="^[\S]+$">
                <div class="valid-feedback">
                    Champ rempli
                </div>
                <div class="invalid-feedback">
                    Les espaces ne sont pas autoriser. <br>
                    Veuillez remplir ce champ s\'il vous plaît.
                </div>
            </div>
            <div class="col-6 d-flex flex-column align-items-center">
                <label for="hiringDate" class="label mb-1">Date d\'embauche</label>
                <input type="date" name="hiringDate" id="hiringDate" class="form-control text-center" required>
                <div class="valid-feedback">
                    Champ rempli
                </div>
                <div class="invalid-feedback">
                    Veuillez remplir ce champ s\'il vous plaît.
                </div>
            </div>
        </div>
        <div class="d-flex flex-column mb-3">
            <label for="salary" class="label mb-1">Salaire</label>
            <input type="number" step="0.01" min="0" name="salary" id="salary" class="form-control text-center align-self-center w-50" required>
            <div class="valid-feedback">
                Champ rempli
            </div>
            <div class="invalid-feedback">
                Les espaces ne sont pas autoriser. <br>
                Veuillez remplir ce champ s\'il vous plaît.
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-6 d-flex flex-column align-items-center">
                <label for="role" class="label mb-1">Rôle</label>
                <select name="role" id="role" form="employeeForm" class="form-select text-center align-self-center">';
            if ($_SESSION["role"] == "admin" || $_SESSION["role"] == "admin manager") {
                echo '
                <option selected value="employee">Employé</option>
                <option value="manager">Manager</option>
                <option value="admin">Administrateur</option>
                <option value="admin manager">Administrateur et Manager</option>';
            } else {
                echo '
                    <option selected value="employee">Employé</option>
                    ';
            }
            echo '</select>
            </div>
            <div class="col-6 d-flex flex-column align-items-center">
                <label for="noService" class="label mb-1">Service</label>
                <select name="noService" id="noService" form="employeeForm" class="form-select text-center align-self-center">';
            foreach ($allServices as $value) {
                if ($_SESSION["role"] == "admin" || $_SESSION["role"] == "admin manager") {
                    echo '<option value="' . $value->getNoservice() . '">' . $value->getName() . '</option>';
                } else {
                    if ($_SESSION["noService"] == $value->getNoservice()) {
                        echo '<option selected value="' . $value->getNoservice() . '">' . $value->getName() . '</option>';
                    }
                }
            }
            echo '</select>
            </div>
        </div>
        <div class="d-flex flex-column mb-3">
            <label for="email" class="label mb-1">Email</label>
            <input type="email" name="email" id="email" class="form-control text-center align-self-center" required>
            <div class="valid-feedback">
                Champ rempli
            </div>
            <div class="invalid-feedback">
                Les espaces ne sont pas autoriser. <br>
                Veuillez remplir ce champ s\'il vous plaît.
            </div>
        </div>
        <button class="btn btn-primary" type="submit" id="submit">Ajouter</button>
        ';

            // Form update employee
        } else if (isset($action) && $action == "update") {
            echo '
            <div class="d-flex flex-column mb-3">
                <label for="noEmployee" class="label mb-1">Numéro d\'employee</label>
                <input type="text" name="noEmployee" id="noEmployee" class="form-control text-center align-self-center w-50" disabled value="' . $employee->getNoEmployee() . '">
            </div>
            <div class="row mb-3">
            <div class="col-6 d-flex flex-column align-items-center">
                <label for="lastName" class="label mb-1">Nom</label>
                <input type="text" name="lastName" id="lastName" class="form-control text-center" required value="' . $employee->getLastName() . '" pattern="^[\S]+$">
                <div class="valid-feedback">
                    Champ rempli
                </div>
                <div class="invalid-feedback">
                    Les espaces ne sont pas autoriser. <br>
                    Veuillez remplir ce champ s\'il vous plaît.
                </div>
            </div>
            <div class="col-6 d-flex flex-column align-items-center">
                <label for="firstName" class="label mb-1">Prénom</label>
                <input type="text" name="firstName" id="firstName" class="form-control text-center" required value="' . $employee->getFirstName() . '" pattern="^[\S]+$">
                <div class="valid-feedback">
                    Champ rempli
                </div>
                <div class="invalid-feedback">
                    Les espaces ne sont pas autoriser. <br>
                    Veuillez remplir ce champ s\'il vous plaît.
                </div>
            </div>
        </div>
        <div class="d-flex flex-column mb-3">
            <label for="dateBirth" class="label mb-1">Date de naissance</label>
            <input type="date" name="dateBirth" id="dateBirth" class="form-control text-center align-self-center w-50" value="' . $dateBirth->format("Y-m-d") . '" required>
            <div class="valid-feedback">
                Champ rempli
            </div>
            <div class="invalid-feedback">
                Veuillez remplir ce champ s\'il vous plaît.
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-6 d-flex flex-column align-items-center">
                <label for="job" class="label mb-1">Poste</label>
                <input type="text" name="job" id="job" class="form-control text-center" required value="' . $employee->getJob() . '">
                <div class="valid-feedback">
                    Champ rempli
                </div>
                <div class="invalid-feedback">
                    Les espaces ne sont pas autoriser. <br>
                    Veuillez remplir ce champ s\'il vous plaît.
                </div>
            </div>
            <div class="col-6 d-flex flex-column align-items-center">
                <label for="hiringDate" class="label mb-1">Date d\'embauche</label>
                <input type="date" name="hiringDate" id="hiringDate" class="form-control text-center" value="' . $hiringDate->format("Y-m-d") . '" required>
                <div class="valid-feedback">
                    Champ rempli
                </div>
                <div class="invalid-feedback">
                    Veuillez remplir ce champ s\'il vous plaît.
                </div>
            </div>
        </div>
        <div class="d-flex flex-column mb-3">
            <label for="salary" class="label mb-1">Salaire</label>
            <input type="number" step="0.01" min="0" name="salary" id="salary" class="form-control text-center align-self-center w-50" value="' . $employee->getSalary() . '" required>
            <div class="valid-feedback">
                Champ rempli
            </div>
            <div class="invalid-feedback">
                Les espaces ne sont pas autoriser. <br>
                Veuillez remplir ce champ s\'il vous plaît.
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-6 d-flex flex-column align-items-center">
                <label for="role" class="label mb-1">Rôle</label>
                <select name="role" id="role" form="employeeForm" class="form-select text-center align-self-center">';
            if ($_SESSION["role"] == "admin" || $_SESSION["role"] == "admin manager") {
                echo '
                <option ' . ($employee->getRole() == "employee" ? "selected" : "") . ' value="employee">Employé</option>
                <option ' . ($employee->getRole() == "manager" ? "selected" : "") . ' value="manager">Manager</option>
                <option ' . ($employee->getRole() == "admin" ? "selected" : "") . ' value="admin">Administrateur</option>
                <option ' . ($employee->getRole() == "admin manager" ? "selected" : "") . ' value="admin manager">Administrateur et Manager</option>';
            } else {
                echo '
                    <option ' . ($employee->getRole() == "employee" ? "selected" : "") . ' value="employee">Employé</option>
                    ';
            }
            echo '</select>
            </div>
            <div class="col-6 d-flex flex-column align-items-center">
                <label for="noService" class="label mb-1">Service</label>
            <select name="noService" id="noService" form="employeeForm" class="form-select text-center align-self-center">';
            foreach ($allServices as $value) {
                if ($_SESSION["role"] == "admin" || $_SESSION["role"] == "admin manager") {
                    if ($value->getNoService() == $employee->getNoService()) {
                        echo '<option selected value="' . $value->getNoservice() . '">' . $value->getName() . '</option>';
                    } else {
                        echo '<option value="' . $value->getNoservice() . '">' . $value->getName() . '</option>';
                    }
                } else {
                    if ($_SESSION["noService"] == $value->getNoservice()) {
                        echo '<option selected value="' . $value->getNoservice() . '">' . $value->getName() . '</option>';
                    }
                }
            }
            echo '</select>
            </div>
        </div>
        <button class="btn btn-primary" type="submit" id="submit">Modifier</button>
        ';
        } else {
            header("Location: employeeController.php");
        }
        ?>
    </form>
</div>