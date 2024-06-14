<?php
require('config.php');
require('globalMethodes.php');
session_start();
gereVerifAccesAdmin();
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
    <h1>Bienvenue sur votre espace utilisateur.</h1> 
    <a href="logout.php">Déconnexion</a>
</body>
</html>