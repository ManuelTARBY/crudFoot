<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../style.css" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
require('../config.php');
require('../globalMethodes.php');

// Vérifie si l'utilisateur est admin, sinon le redirige vers sa page d'utilisateur
gereVerifAccesAdmin();

if (isset($_REQUEST['name'], $_REQUEST['year'], $_REQUEST['location'], $_REQUEST['winner'])){
  // récupérer le nom de la compétition 
  $name = stripslashes($_REQUEST['name']);
  $name = mysqli_real_escape_string($conn, $name); 
  // récupérer l'année de la compétition 
  $year = stripslashes($_REQUEST['year']);
  $year = mysqli_real_escape_string($conn, $year);
  // récupérer l'organisateur
  $location = stripslashes($_REQUEST['location']);
  $location = mysqli_real_escape_string($conn, $location);
  // récupérer le vainqueur de la compétition
  $winner = stripslashes($_REQUEST['winner']);
  $winner = mysqli_real_escape_string($conn, $winner);
  
    $query = "INSERT into `competition` (`name`, `year`, `location`, `winner`)
          VALUES ('$name', '$year', '$location', '$winner')";
    $res = mysqli_query($conn, $query);

    if($res){
       echo "<div class='sucess'>
             <h3>La compétition a été créée avec succés.</h3>
             <p>Cliquez <a href='home.php'>ici</a> pour retourner à la page d'accueil</p>
       </div>";
    }
}else{
?>
<div>
<button class="button-retour" onclick="window.location.href='home.php';">
    Retour
  </button>
  <form class="box" action="" method="post">
    <h1 class="box-title">Créer une compétition</h1>
    <input type="text" class="box-input" name="name" 
    placeholder="Nom de compétition" required />
    
    <input type="text" class="box-input" name="year" 
    placeholder="Année" required />
    
    <input type="text" class="box-input" name="location" 
    placeholder="Organisateur" required />
    
    <input type="text" class="box-input" name="winner" 
    placeholder="Vainqueur" required />
    
    <input type="submit" name="submit" value="+ Add" class="box-button" />
  </form>
</div>
  
<?php } ?>
</body>
</html>