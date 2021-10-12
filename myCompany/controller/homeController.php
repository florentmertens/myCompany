<?php
if (!isset($_SESSION)) {
    session_start();
}

// Title of current page
$title = "Accueil";

// Import header, home page and footer
require_once __DIR__ . "/../view/header.php";
require_once __DIR__ . "/../view/home.php";
require_once __DIR__ . "/../view/footer.php";
