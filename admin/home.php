<?php
require('../config.php');
require('../globalMethodes.php');


// Vérifie si l'utilisateur est admin, sinon le redirige vers sa page d'utilisateur
gereVerifAccesAdmin();

  // Récupère toutes les compétitions
  $query = 'SELECT * FROM competition ORDER BY winner';
  $res = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Panneau d'administration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style.css" />
  </head>
  <body>
    <div class="success">
    <h1>Bienvenue <?php echo $_SESSION['username']; ?> !</h1>
    <p>Espace d'administration</p>
    <div class="button-group">
      <button class="button-create" onclick="window.location.href='add_competition.php';">Ajouter une compétition</button>
      <button class="button-update" onclick="window.location.href='update_competition.php';">Modifier une compétition</button>
      <button class="button-delete" onclick="window.location.href='delete_competition.php';">Supprimer une compétition</button>
      <button class="button-deco" onclick="window.location.href='../logout.php';">Déconnexion</button>
    </div>
    </ul>
    <div>
    <?php echo "<table>" ?>
    <tr>
            <th>Nom</th>
            <th>Année</th>
            <th>Localisation</th>
            <th>Vainqueur</th>
        </tr>
            <?php foreach($res as $unRes){
                    echo "<tr><td>
                    {$unRes['name']}
                    </td>
                    <td>
                    {$unRes['year']}
                    </td>
                    <td>
                    {$unRes['location']}
                    </td>
                    <td>
                    {$unRes['winner']}
                    </td>
                    </tr>";
                    }
            ?>
        <?php echo "</table>" ?>
    </div>
    </div>
  </body>
</html>