<div class="container d-flex flex-column justify-content-center align-items-center text-center h-75">
    <h1 class="mb-4">MyCompany</h1>
    <p class="mb-5">Bienvenue chez My Company.<br>
        MyCompany est une application web qui vous permet de regrouper tous les employés et services de votre entreprise. <br>
        Vous aurez la possibilité d'ajouter des nouveaux employés et services, mais aussi de modifier ou supprimer des employés et des services. <br>
        Chaque employé possède un compte utilisateur où il pourra consulter les services ou les autres employées de la même entreprise.</p>
    <?php
    if (isset($_SESSION["idUser"])) {
        echo '<a href="userController.php"><button class="btn btn-outline-dark">Mon profil</button></a>';
    } else {
        echo '<a href="loginController.php"><button class="btn btn-outline-dark">Connexion</button></a>';
    }
    ?>
</div>