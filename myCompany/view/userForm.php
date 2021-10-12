<div class="container d-flex flex-column justify-content-center align-items-center h-75 text-center">
    <h1 class="mb-4">Modification informations utilisateur</h1>
    <?php
    if (
        isset($_GET["action"]) && $_GET["action"] == "updatePassword"
        && isset($_GET["error"]) && $_GET["error"] == 1
    ) {
        echo '<div class="alert alert-danger" role="alert">
        Le mot de passe actuel est incorrect.
            </div>';
    } elseif (
        isset($_GET["action"]) && $_GET["action"] == "updatePassword"
        && isset($_GET["error"]) && $_GET["error"] == 2
    ) {
        echo '<div class="alert alert-danger" role="alert">
                La confirmation du nouveau mot de passe n\'est pas identique au nouveau mot de passe
            </div>';
    }
    ?>
    <form action="userController.php<?php echo isset($action) ? ($action == "userInfo" ? "?action=updateUserInfo" : ($action == "password" ? "?action=updatePassword" : "")) : "" ?>" method="post" class="needs-validation" novalidate>
        <?php
        if (isset($action) && $action == "password") {
            echo '<div class="mb-3">
                    <label for="currentPassword" class="mb-2">
                        Mot de passe actuel
                    </label>
                    <div class="input-group mb-2 mr-sm-2">
                        <input type="password" name="currentPassword" id="currentPassword" placeholder="Votre mot de passe actuel" class="form-control text-center" required pattern="^[\S]+$">
                        <div class="input-group-prepend h-100">
                            <div class="input-group-text h-100"><i class="far fa-eye-slash py-1 iconPassword"></i></div>
                        </div>
                        <div class="valid-feedback">
                            Champ rempli
                        </div>
                        <div class="invalid-feedback">
                            Les espaces ne sont pas autoriser. <br>
                            Veuillez remplir ce champ s\'il vous plaît.
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="newPassword" class="mb-2">
                        Nouveau mot de passe
                    </label>
                    <div class="input-group mb-2 mr-sm-2">
                        <input type="password" name="newPassword" id="newPassword" placeholder="Votre nouveau mot de passe" class="form-control text-center" required pattern="^[\S]+$">
                        <div class="input-group-prepend h-100">
                            <div class="input-group-text h-100"><i class="far fa-eye-slash py-1 iconPassword"></i></div>
                        </div>
                        <div class="valid-feedback">
                            Champ rempli
                        </div>
                        <div class="invalid-feedback">
                            Les espaces ne sont pas autoriser. <br>
                            Veuillez remplir ce champ s\'il vous plaît.
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="confNewPassword" class="mb-2">
                        Confirmation nouveau mot de passe
                    </label>
                    <div class="input-group mb-2 mr-sm-2">
                        <input type="password" name="confNewPassword" id="confNewPassword" placeholder="Comfirmé votre nouveau mot de passe" class="form-control text-center" required pattern="^[\S]+$">
                        <div class="input-group-prepend h-100">
                            <div class="input-group-text h-100"><i class="far fa-eye-slash py-1 iconPassword"></i></div>
                        </div>
                        <div class="valid-feedback">
                            Champ rempli
                        </div>
                        <div class="invalid-feedback">
                            Les espaces ne sont pas autoriser. <br>
                            Veuillez remplir ce champ s\'il vous plaît.
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit" id="submit">Valider</button>';
        } else if (isset($action) && $action == "userInfo") {
            echo '<div class="mb-3">
                    <label for="idUser" class="mb-2">
                        Id utilisateur
                    </label>
                    <input type="text" name="idUser" id="idUser" disabled value="' . $data->getIdUser() . '" class="form-control text-center">
                </div>
                <div class="mb-3">
                    <label for="pseudo" class="mb-2">
                            Pseudo
                    </label>
                    <input type="text" name="pseudo" id="pseudo" value="' . $data->getPseudo() . '" class="form-control text-center" required placeholder="Votre nouveau pseudo" pattern="^[\S]+$">
                    <div class="valid-feedback">
                        Champ rempli
                    </div>
                    <div class="invalid-feedback">
                        Les espaces ne sont pas autoriser. <br>
                        Veuillez remplir ce champ s\'il vous plaît.
                    </div>    
                </div>
                <div class="mb-3">
                    <label for="email" class="mb-2">
                        Email
                    </label>
                    <input type="text" name="email" id="email" value="' . $data->getEmail() . '" class="form-control text-center" required placeholder="Votre nouvelle Email" pattern="^[\S]+$">
                    <div class="valid-feedback">
                        Champ rempli
                    </div>
                    <div class="invalid-feedback">
                        Les espaces ne sont pas autoriser. <br>
                        Veuillez remplir ce champ s\'il vous plaît.
                    </div>    
                </div>
                <button class="btn btn-primary" type="submit" id="submit">Valider</button>';
        } else {
            header('Location: userController.php');
        }
        ?>
    </form>
</div>