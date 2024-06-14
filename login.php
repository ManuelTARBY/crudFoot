  <!DOCTYPE html>
  <html>
  <head>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
<?php
require('config.php');
session_start();

if (isset($_POST['username'])){
  $username = stripslashes($_REQUEST['username']);
  $username = mysqli_real_escape_string($conn, $username);
  $_SESSION['username'] = $username;
  $password = stripslashes($_REQUEST['password']);
  $password = mysqli_real_escape_string($conn, $password);
    $query = "SELECT * FROM `users` WHERE username='$username' 
  and password='".hash('sha256', $password)."'";
  
  $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
  
  if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);
    $_SESSION['type'] = $user['type'];
    if ($user['type'] == 'admin') {
      header('location: admin/home.php');      
    } else {
      header('location: index.php');
    }
  } else {
    $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
  }
}
?>
<div class="container">
  <form class="box" action="" method="post" name="login">
    <h1 class="box-title">Connexion</h1>
    <input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur" required>
    <input type="password" class="box-input" name="password" placeholder="Mot de passe" required>
    <input type="submit" value="Connexion" name="submit" class="box-button">
    <p class="box-register">Vous êtes nouveau ici ? 
      <a href="register.php">S'inscrire</a>
    </p>
    <?php if (!empty($message)) { ?>
      <p class="errorMessage"><?php echo $message; ?></p>
    <?php } ?>
  </form>
</div>
</body>
</html>
