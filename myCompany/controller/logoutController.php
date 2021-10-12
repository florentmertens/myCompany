<?php
if (!isset($_SESSION)) {
    session_start();
}
// logout user
session_destroy();
header('Location: homeController.php');
