<?php
require('../config.php');
require('../globalMethodes.php');

  // Initialiser la session
  session_start();
  // Vérifiez si l'utilisateur est connecté, sinon le redirige vers la page de connexion
  if(!isset($_SESSION["username"])){
    header("Location: login.php");
    exit();
  }

// Vérifie si l'utilisateur est admin, sinon le redirige vers sa page d'utilisateur
gereVerifAccesAdmin();

  // Récupère toutes les compétitions
  $query = 'SELECT * FROM competition ORDER BY winner';
  $res = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html>
  <head>
  <link rel="stylesheet" href="../style.css" />
  </head>
  <body>
    <div class="success">
    <h1>Bienvenue <?php echo $_SESSION['username']; ?> !</h1>
    <p>Espace d'administration</p>
    <a href="add_competition.php">Ajouter une compétition</a> | 
    <a href="update_competition.php">Modifier une compétition</a> | 
    <a href="delete_competition.php">Supprimer une compétition</a> | 
    <a href="../login.php">Déconnexion</a>
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