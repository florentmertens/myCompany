<div class="container d-flex flex-column justify-content-center align-items-center h-75 text-center">
    <h1 class="mb-4">Connexion</h1>
    <?php
    if (isset($_GET["error"])) {
        echo '<div class="alert alert-danger" role="alert">
                Votre pseudo ou mot de passe est incorrect
            </div>';
    }
    ?>
    <form action="loginController.php?action=connect" method="post" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="pseudo" class="mb-2">Pseudo</label>
            <input type="text" class="form-control text-center" name="pseudo" id="pseudo" placeholder="Votre pseudo" required pattern="^[\S]+$">
            <div class="valid-feedback">
                Champ rempli
            </div>
            <div class="invalid-feedback">
                Les espaces ne sont pas autoriser. <br>
                Veuillez remplir ce champ s'il vous plaît.
            </div>
        </div>
        <div class="mb-4">
            <label for="password" class="mb-2">Mot de passe</label>
            <div class="input-group mb-2 mr-sm-2">
                <input type="password" class="form-control text-center" name="password" id="password" placeholder="Votre mot de passe" required pattern="^[\S]+$">
                <div class="input-group-prepend h-100">
                    <div class="input-group-text h-100"><i class="far fa-eye-slash py-1 iconPassword"></i></div>
                </div>
            </div>
            <div class="valid-feedback">
                Champ rempli
            </div>
            <div class="invalid-feedback">
                Les espaces ne sont pas autoriser. <br>
                Veuillez remplir ce champ s'il vous plaît.
            </div>
        </div>
        <button class="btn btn-primary" type="submit" id="submit">Connexion</button>
    </form>
</div>