<?php
require('config.php');
require('globalMethodes.php');
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div>
    <h1>Bienvenue sur votre espace utilisateur.</h1> 
    <div class="button-group">
      <button class="button-deco" onclick="window.location.href='logout.php';">Déconnexion</button>
    </div>
  </div>
</body>
</html>