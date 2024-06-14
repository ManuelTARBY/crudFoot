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

if (isset($_GET['delete_id'])) {
  // récupérer l'id de la compétition à supprimer
  $id = stripslashes($_GET['delete_id']);
  $id = mysqli_real_escape_string($conn, $id);

  // Préparer la requête de suppression
  $query = "DELETE FROM competition WHERE id='$id'";

  $res = mysqli_query($conn, $query);

  if ($res) {
    echo "<div class='success'>
          <h3>La compétition a été supprimée avec succès.</h3>
          <p>Cliquez <a href='home.php'>ici</a> pour retourner à la page d'accueil</p>
    </div>";
  } else {
    echo "<div class='error'>
          <h3>Erreur lors de la suppression de la compétition.</h3>
          <p>Cliquez <a href='home.php'>ici</a> pour retourner à la page d'accueil</p>
    </div>";
  }
} else {
  // Afficher la liste des utilisateurs avec un bouton de suppression
  $query = "SELECT * FROM competition ORDER BY winner";
  $result = mysqli_query($conn, $query);

  echo "<h1>Sélectionner la compétition à supprimer</h1>";
  echo "<table class='box-table'>";
  echo "<tr><th>ID</th><th>Nom</th><th>Année</th><th>Organisateur</th><th>Vainqueur</th></tr>";

  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['year']}</td>
            <td>{$row['location']}</td>
            <td>{$row['winner']}</td>
            <td><a href='?delete_id={$row['id']}' class='box-button-delete'>Supprimer</a></td>
          </tr>";
  }

  echo "</table>";
}
?>
  <button class="button-retour" onclick="window.location.href='home.php';">
    Retour
  </button>
  </div>
</body>
</html>