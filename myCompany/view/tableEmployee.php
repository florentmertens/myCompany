<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<div class="table-responsive text-center m-5">
    <h1 class="mb-4">Employés</h1>
    <?php
    if (
        $_SESSION["role"] == "admin"
        || $_SESSION["role"] == "manager"
        || $_SESSION["role"] == "admin manager"
    ) {
        echo '<a href="employeeController.php?action=add">
                <button type="button" class="btn btn-primary mb-4">
                    Ajouter un employé
                </button>
            </a>';
    }
    ?>
    <table class="table table-striped table-hover align-middle">
        <thead>
            <tr>
                <th>Numéro Employé</th>
                <th>Nom de famille</th>
                <th>Prénom</th>
                <th>Date de naissance</th>
                <th>Poste</th>
                <th>Numéro du manager</th>
                <th>Date d'embauche</th>
                <th>Salaire</th>
                <th>Numéro de service</th>
                <?php
                if (
                    $_SESSION["role"] == "admin"
                    || $_SESSION["role"] == "manager"
                    || $_SESSION["role"] == "admin manager"
                ) {
                    echo '<th>Modifier</th>
                        <th>Supprimer</th>';
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($allEmployees as $value) {
                if (
                    $_SESSION["noEmployee"] == $value->getNoEmployee()
                    || $_SESSION["role"] == "admin"
                    || $_SESSION["role"] == "manager" && $_SESSION["noService"] == $value->getNoService()
                    || $_SESSION["role"] == "admin manager"
                ) {
                    $salary = $value->getSalary();
                } else {
                    $salary = "";
                }
                echo '<tr>
                            <td>' . $value->getNoEmployee() . '</td>
                            <td>' . $value->getLastName() . '</td>
                            <td>' . $value->getFirstName() . '</td>
                            <td>' . $value->getDateBirth() . '</td>
                            <td>' . $value->getJob() . '</td>
                            <td>' . $value->getNoManager() . '</td>
                            <td>' . $value->getHiringDate() . '</td>
                            <td>' . $salary . ' €</td>
                            <td>' . $value->getNoService() . '</td>';
                if (
                    $_SESSION["role"] == "admin"
                    || $_SESSION["role"] == "admin manager"
                    || ($_SESSION["role"] == "manager" && $_SESSION["noEmployee"] == $value->getNoManager() && $value->getRole() != "admin" && $value->getRole() != "admin manager" && $value->getRole() != "manager")
                ) {
                    echo '<td>
                            <a href="employeeController.php?action=update&id=' . $value->getNoEmployee() . '">
                                <button type="button" class="btn btn-success">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                            </a>
                        </td>
                        <td>
                            <a href="employeeController.php?action=delete&id=' . $value->getNoEmployee() . '">
                                <button type="button" class="btn btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </a>
                        </td>
                    </tr>';
                } else if (
                    $_SESSION["role"] == "manager" && $_SESSION["noEmployee"] != $value->getNoManager()
                    || $_SESSION["role"] == "manager" && $value->getRole() == "admin"
                    || $_SESSION["role"] == "manager" && $value->getRole() == "admin manager"
                    || $_SESSION["role"] == "manager" && $value->getRole() == "manager"
                ) {
                    echo '<td>
                            Accès refusé
                        </td>
                        <td>
                            Accès refusé
                        </td>
                    </tr>';
                }
            }
            ?>
        </tbody>
    </table>
</div>
</body>

</html>