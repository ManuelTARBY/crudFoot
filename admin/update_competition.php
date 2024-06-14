<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../style.css" />
</head>
<body>
<?php
require('../config.php');
require('../globalMethodes.php');

  // Vérifiez si l'utilisateur est connecté, sinon le redirige vers la page de connexion
  if(!isset($_SESSION["username"])){
    header("Location: ../login.php");
    exit();
  }

// Vérifie si l'utilisateur est admin, sinon le redirige vers sa page d'utilisateur
gereVerifAccesAdmin();

if (isset($_REQUEST['id'], $_REQUEST['name'], $_REQUEST['year'], $_REQUEST['location'], $_REQUEST['winner'])) {
  // récupérer l'id de la compétition
  $id = stripslashes($_REQUEST['id']);
  $id = mysqli_real_escape_string($conn, $id);
  // récupérer le nom de la compétition
  $name = stripslashes($_REQUEST['name']);
  $name = mysqli_real_escape_string($conn, $name); 
  // récupérer l'année de la compétition
  $year = stripslashes($_REQUEST['year']);
  $year = mysqli_real_escape_string($conn, $year);
  // récupérer l'organisateur de la compétition
  $location = stripslashes($_REQUEST['location']);
  $location = mysqli_real_escape_string($conn, $location);
  // récupérer le vainqueur de la compétition
  $winner = stripslashes($_REQUEST['winner']);
  $winner = mysqli_real_escape_string($conn, $winner);

  // Préparer la requête de mise à jour
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
  // Si l'ID de la compétition est fourni, récupérer les détails de la compétition pour pré-remplir le formulaire
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

  <input type="submit" name="submit" value="Update" class="box-button" />
</form>
<?php 
} else {

$query = "SELECT * FROM competition ORDER BY year";
  $result = mysqli_query($conn, $query);

  echo "<h1 class='box-title'>Choisissez une compétition à modifier</h1>";
  echo "<table class='box-table'>";
  echo "<tr><th>ID</th><th>Nom</th><th>Année</th><th>Organisateur</th><th>Vainqueur</th><th>Action</th></tr>";

  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['year']}</td>
            <td>{$row['location']}</td>
            <td>{$row['winner']}</td>
            <td><a href='?edit_id={$row['id']}' class='box-button'>Modifier</a></td>
          </tr>";
  }

  echo "</table>";
 } ?>
</body>
</html>