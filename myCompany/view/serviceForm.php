<div class="container d-flex flex-column justify-content-center align-items-center mt-5 text-center">
    <h1 class="mb-4"><?php echo $titleForm ?></h1>
    <form id="serviceForm" action="serviceController.php<?php echo isset($action) ? ($action == "add" ? "?action=add" : ($action == "update" ? "?action=update&id=" . $service->getNoService() : "")) : "" ?>" method="post" class="needs-validation mb-5" novalidate>
        <?php
        if (isset($error)) {
            echo '<div class="alert alert-danger" role="alert">
                    ' . $error . '
                </div>';
        }
        // Form add service
        if (isset($action) && $action == "add") {
            echo '<div class="d-flex flex-column mb-3">
                    <label for="name" class="label mb-1">Nom du service</label>
                    <input type="text" name="name" id="name" class="form-control text-center align-self-center" required pattern="^[\S]+$">
                    <div class="valid-feedback">
                            Champ rempli
                        </div>
                        <div class="invalid-feedback">
                            Les espaces ne sont pas autoriser. <br>
                            Veuillez remplir ce champ s\'il vous plaît.
                        </div>
                </div>
                <div class="d-flex flex-column mb-3">
                    <label for="city" class="label mb-1">Ville</label>
                    <input type="text" name="city" id="city" class="form-control text-center align-self-center" required pattern="^[\S]+$">
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
                    <label for="name" class="label mb-1">Nom du service</label>
                    <input type="text" name="name" id="name" class="form-control text-center align-self-center" disabled value="' . $service->getNoService() . '">
                </div>
            <div class="d-flex flex-column mb-3">
                    <label for="name" class="label mb-1">Nom du service</label>
                    <input type="text" name="name" id="name" class="form-control text-center align-self-center" required pattern="^[\S]+$" value="' . $service->getName() . '">
                    <div class="valid-feedback">
                            Champ rempli
                        </div>
                        <div class="invalid-feedback">
                            Les espaces ne sont pas autoriser. <br>
                            Veuillez remplir ce champ s\'il vous plaît.
                        </div>
                </div>
                <div class="d-flex flex-column mb-3">
                    <label for="city" class="label mb-1">Ville</label>
                    <input type="text" name="city" id="city" class="form-control text-center align-self-center" required pattern="^[\S]+$" value="' . $service->getCity() . '">
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
        } else {
            header("Location: serviceController.php");
        }
        ?>
    </form>
</div>