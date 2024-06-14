<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../style.css" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <div>

    <?php
require('../config.php');
require('../globalMethodes.php');


// Vérifie si l'utilisateur est admin, sinon le redirige vers sa page d'utilisateur
gereVerifAccesAdmin();

if (isset($_REQUEST['id'], $_REQUEST['name'], $_REQUEST['year'], $_REQUEST['location'], $_REQUEST['winner'])) {
  // récupére l'id de la compétition
  $id = stripslashes($_REQUEST['id']);
  $id = mysqli_real_escape_string($conn, $id);
  // récupére le nom de la compétition
  $name = stripslashes($_REQUEST['name']);
  $name = mysqli_real_escape_string($conn, $name); 
  // récupére l'année de la compétition
  $year = stripslashes($_REQUEST['year']);
  $year = mysqli_real_escape_string($conn, $year);
  // récupére l'organisateur de la compétition
  $location = stripslashes($_REQUEST['location']);
  $location = mysqli_real_escape_string($conn, $location);
  // récupére le vainqueur de la compétition
  $winner = stripslashes($_REQUEST['winner']);
  $winner = mysqli_real_escape_string($conn, $winner);
  
  // Prépare la requête de mise à jour
  $query = "UPDATE competition SET name='$name', year='$year', location='$location', winner='$winner' WHERE id='$id'";
  
  $res = mysqli_query($conn, $query);
  
  if($res) {
    echo "<div class='success'>
    <h3>La compétition a été mise à jour avec succès.</h3>
    <p>Cliquez <a href='home.php'>ici</a> pour retourner à la page d'accueil</p>
    </div>";
  } else {
    echo "Raté !";
  }
} else if (isset($_GET['edit_id'])) {
  // Si l'ID de la compétition est fourni, récupére les détails de la compétition pour pré-remplir le formulaire
  $id = stripslashes($_GET['edit_id']);
  $id = mysqli_real_escape_string($conn, $id);
  
  $query = "SELECT * FROM competition WHERE id='$id'";
  $result = mysqli_query($conn, $query);
  $comp = mysqli_fetch_assoc($result);
  ?>
<form class="box" action="" method="post">
  <h1 class="box-title">Mettre à jour la compétition</h1>
  <input type="hidden" name="id" value="<?php echo $comp['id']; ?>" />
  <input type="text" class="box-input" name="name" placeholder="Nom de compétition" value="<?php echo $comp['name']; ?>" required />
  <input type="text" class="box-input" name="year" placeholder="Année" value="<?php echo $comp['year']; ?>" required />
  <input type="text" class="box-input" name="location" placeholder="Organisateur" value="<?php echo $comp['location']; ?>" required />
  <input type="text" class="box-input" name="winner" placeholder="Vainqueur" value="<?php echo $comp['winner']; ?>" required />
  
  <input class="box-button" type="submit" name="submit" value="Mettre à jour" />
</form>
<?php 
} else {
  
  $query = "SELECT * FROM competition ORDER BY winner";
  $result = mysqli_query($conn, $query);
  echo "<h1>Sélectionner la compétition à modifier</h1>";
  echo "<table class='box-table'>";
  echo "<tr><th>ID</th><th>Nom</th><th>Année</th><th>Organisateur</th><th>Vainqueur</th><th>Action</th></tr>";
  
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
    <td>{$row['id']}</td>
    <td>{$row['name']}</td>
    <td>{$row['year']}</td>
    <td>{$row['location']}</td>
    <td>{$row['winner']}</td>
    <td class='td-button'><a href='?edit_id={$row['id']}' class='box-button-update'>Modifier</a></td>
    </tr>";
  }
  
  echo "</table>";
} ?>
<button class="button-retour" onclick="window.location.href='home.php';">Retour</button>
</div>
</body>
</html>