<div class="table-responsive text-center m-5">
    <h1 class="mb-4">Services</h1>
    <?php
    if (
        $_SESSION["role"] == "admin" || $_SESSION["role"] == "admin manager"
    ) {
        echo '<a href="serviceController.php?action=add">
                <button type="button" class="btn btn-primary mb-4">
                    Ajouter un service
                </button>
            </a>';
    }
    ?>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Numéro du service</th>
                <th>Nom du service</th>
                <th>Ville du service</th>
                <?php
                if ($_SESSION["role"] == "admin" || $_SESSION["role"] == "admin manager") {
                    echo '<th>Modifier</th>
                        <th>Supprimer</th>';
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($allServices as $value) {
                echo '<tr>
                        <td>' . $value->getNoService() . '</td>
                        <td>' . $value->getName() . '</td>
                        <td>' . $value->getCity() . '</td>';
                if ($_SESSION["role"] == "admin" || $_SESSION["role"] == "admin manager") {
                    echo '<td>
                            <a href="serviceController.php?action=update&id=' . $value->getNoService() . '">
                                <button type="button" class="btn btn-success">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                            </a>
                        </td>
                        <td>
                            <a href="serviceController.php?action=delete&id=' . $value->getNoService() . '">
                                <button type="button" class="btn btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </a>
                        </td>
                </tr>';
                }
            }
            ?>
        </tbody>
    </table>
</div>