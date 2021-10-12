<div class="container d-flex flex-column justify-content-center align-items-center mt-5 text-center">
    <?php
    if ($action == "addSuccess") {
        echo '<div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Le service est enregistré</h4>
                    <p>Le nouveau service a été créer.</p>
                </div>
                <a href="serviceController.php"><button class="btn btn-primary">Retour au tableau des services</button></a>
                ';
    } elseif ($action == "accessDenied") {
        echo '<div class="alert alert-warning" role="alert">
                    <h4 class="alert-heading">Accès refusé !</h4>
                    <hr>
                    <p class="mb-0">Accès refusé. Vous n\'avez pas l\'autorisation nécessaire.</p>
                </div>
                <a href="serviceController.php"><button class="btn btn-primary">Retour au tableau des services</button></a>
                ';
    } elseif ($action == "serviceNotFound") {
        echo '<div class="alert alert-warning" role="alert">
                            <h4 class="alert-heading">Service introuvable !</h4>
                        </div>
                        <a href="serviceController.php"><button class="btn btn-primary">Retour au tableau des services</button></a>
                        ';
    } elseif ($action == "updateSuccess") {
        echo '<div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Service modifié.</h4>
                <hr>
                <p>Les informations du service ont été modifiées.</p>
                <a href="serviceController.php"><button class="btn btn-primary">Retour au tableau des services</button></a>
            </div>
    ';
    } elseif ($action == "deleteSuccess") {
        echo '<div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Service supprimer.</h4>
                <hr>
                <p>Le service a était supprimé définitivement de la base de données.</p>
                <a href="serviceController.php"><button class="btn btn-primary">Retour au tableau des services</button></a>
            </div>
    ';
    }
