<div class="container d-flex flex-column justify-content-center align-items-center text-center mt-5">
    <div class="row mb-5">
        <div class="col-12">
            <img src="../public/images/profil.png" class="img-fluid mb-4" width="200px" alt="photo de profil">
            <h4><?php echo $_SESSION["firstName"] . " " . $_SESSION["lastName"] ?></h4>
            <p><?php echo $_SESSION["email"] ?></p>
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column mb-3">
                <h2 class="mb-3">Informations personnelle</h2>
                <label class="label mb-1">Numéro d'employee</label>
                <input class="form-control text-center align-self-center w-50" value="<?php echo $_SESSION["noEmployee"] ?>" disabled>
            </div>
            <div class="row mb-3">
                <div class="col-6 d-flex flex-column align-items-center">
                    <label class="label mb-1">Nom</label>
                    <input class="form-control text-center" value="<?php echo $_SESSION["lastName"] ?>" disabled>
                </div>
                <div class="col-6 d-flex flex-column align-items-center">
                    <label class="label mb-1">Prénom</label>
                    <input class="form-control text-center" value="<?php echo $_SESSION["firstName"] ?>" disabled>
                </div>
            </div>
            <div class="d-flex flex-column mb-3">
                <label class="label mb-1">Date de naissance</label>
                <input class="form-control text-center align-self-center w-50" value="<?php echo $_SESSION["dateBirth"] ?>" disabled>
            </div>
            <div class="row mb-3">
                <div class="col-6 d-flex flex-column align-items-center">
                    <label class="label mb-1">Poste</label>
                    <input class="form-control text-center" value="<?php echo $_SESSION["job"] ?>" disabled>
                </div>
                <div class="col-6 d-flex flex-column align-items-center">
                    <label class="label mb-1">Date d'embauche</label>
                    <input class="form-control text-center" value="<?php echo $_SESSION["hiringDate"] ?>" disabled>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-6 d-flex flex-column align-items-center">
                    <label class="label mb-1">Numéro du manager</label>
                    <input class="form-control text-center" value="<?php echo $_SESSION["noManager"] ?>" disabled>
                </div>
                <div class="col-6 d-flex flex-column align-items-center">
                    <label class="label mb-1">Numéro du service</label>
                    <input class="form-control text-center" value="<?php echo $_SESSION["noService"] ?>" disabled>
                </div>
            </div>
        </div>
        <hr>
        <div>
            <h2 class="mb-3">Informations utilisateur</h2>
            <div class="row my-3">
                <div class="col-6">
                    <a href="userController.php?action=updateUserInfo" class="m-2"><button class="btn btn-success">Modifier les informations utilisateur</button></a>
                </div>
                <div class="col-6">
                    <a href="userController.php?action=updatePassword" class="m-2"><button class="btn btn-success">Modifier le mot de passe utilisateur</button></a>
                </div>
            </div>
            <div class="row my-3">
                <div class="d-flex flex-column mb-3">
                    <h2 class="mb-3">Informations personnelle</h2>
                    <label class="label mb-1">Id utilisateur</label>
                    <input class="form-control text-center align-self-center w-50" value="<?php echo $_SESSION["idUser"] ?>" disabled>
                </div>
                <div class="col-6 d-flex flex-column align-items-center">
                    <label class="label mb-1">Pseudo</label>
                    <input class="form-control text-center" value="<?php echo $_SESSION["pseudo"] ?>" disabled>
                </div>
                <div class="col-6 d-flex flex-column align-items-center">
                    <label class="label mb-1">Email</label>
                    <input class="form-control text-center" value="<?php echo $_SESSION["email"] ?>" disabled>
                </div>
            </div>
        </div>
    </div>
</div>