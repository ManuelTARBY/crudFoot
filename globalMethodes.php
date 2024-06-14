<?php
function gereVerifAccesAdmin() {

    // Vérifie que la session est démarrée
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Vérifiez si l'utilisateur est connecté
    if (!isset($_SESSION["username"])) {
        header("Location: ../login.php");
        exit();
    }

    // Vérifiez si l'utilisateur a un rôle d'administrateur
    if (!isset($_SESSION["type"]) || $_SESSION["type"] !== 'admin') {
        header("Location: index.php"); // Redirige vers une page utilisateur normale
        exit();
    }
}