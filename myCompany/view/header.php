<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/2cd317b115.js" crossorigin="anonymous"></script>
</head>

<body class="vh-100">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="homeController.php">MyCompany</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <?php
                if (isset($_SESSION["idUser"])) {
                    echo '<div class="collapse navbar-collapse" id="navbarsExample07">
                            <ul class="navbar-nav mr-auto">
                            <li class="nav-item active"><a href="employeeController.php" class="nav-link">Tableau employés</a></li>
                            <li class="navbar-item"><a href="serviceController.php" class="nav-link">Tableau services</a></li>
                            <li class="navbar-item"><a href="userController.php" class="nav-link">Mon profil</a></li>
                            <li class="navbar-item"><a href="logoutController.php" class="nav-link">Déconnexion</a></li>
                            </ul>
                        </div>';
                } else {
                    echo '<div class="collapse navbar-collapse" id="navbarsExample07">
                            <ul class="navbar-nav mr-auto">
                            <li class="nav-item active"><a href="loginController.php" class="nav-link">Connexion</a></li>
                            </ul>
                        </div>';
                }
                ?>
            </div>
        </nav>
    </header>