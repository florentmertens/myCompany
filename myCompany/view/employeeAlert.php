<div class="container d-flex flex-column justify-content-center align-items-center mt-5 text-center">
    <?php
    if ($action == "addSuccess") {
        echo '<div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">L\'employé est enregistré</h4>
                    <p>Un compte utilisateur a été créer, n\'oublier pas de lui fourni ces informations de connexion qui se trouve ci-dessous.</p>
                    <hr>
                    <p class="mb-0">Pseudo : ' . $newUser->getPseudo() . '</p>
                    <p class="mb-0">Mot de passe : date de naissance (exemple : 25061998)</p>
                </div>
                <a href="employeeController.php"><button class="btn btn-primary">Retour au tableau d\'employés</button></a>
                ';
    } elseif ($action == "accessDenied") {
        echo '<div class="alert alert-warning" role="alert">
                    <h4 class="alert-heading">Accès refusé !</h4>
                    <hr>
                    <p class="mb-0">Accès refusé. Vous n\'avez pas l\'autorisation nécessaire.</p>
                </div>
                <a href="employeeController.php"><button class="btn btn-primary">Retour au tableau d\'employés</button></a>
                ';
    } elseif ($action == "employeeNotFound") {
        echo '<div class="alert alert-warning" role="alert">
                            <h4 class="alert-heading">Employé introuvable !</h4>
                        </div>
                        <a href="employeeController.php"><button class="btn btn-primary">Retour au tableau d\'employés</button></a>
                        ';
    } elseif ($action == "updateSuccess") {
        echo '<div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Employé modifier.</h4>
                <hr>
                <p>Les informations de l\'employé ont été modifiées.</p>
                <a href="employeeController.php"><button class="btn btn-primary">Retour au tableau d\'employés</button></a>
            </div>
    ';
    } elseif ($action == "deleteSuccess") {
        echo '<div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Employé supprimé.</h4>
                <hr>
                <p>Le compte utilisateur et les informations de l\'employée on était supprimé définitivement de la base de données.</p>
                <a href="employeeController.php"><button class="btn btn-primary">Retour au tableau d\'employés</button></a>
            </div>
    ';
    }
