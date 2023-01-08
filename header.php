<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bazy Projekt | Marcin Dzierwa</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="css/main.css">
</head>

<body>

  <nav class="blue lighten-3" role="navigation">
    <div class="nav-wrapper container">
      <a href="index.php" class="brand-logo left">Siema</a>
      <ul class="right">
        <li><a href="index.php">Home</a></li>
        <?php
        if (isset($_SESSION["useruid"])) {
          echo '<li><a href="favourites.php">Favourites</a></li>';

          if ($_SESSION["userrole"] == "admin") {
            echo '<li><a href="adminpaneltables.php">Admin Panel</a></li>';
          }

          echo '<li><a href="includes/logout.inc.php">Log out</a></li>';
        } else {
          echo '<li><a href="signup.php">Sign Up</a></li>';
          echo '<li><a href="login.php">Log in</a></li>';
        }
        ?>
      </ul>
    </div>
  </nav>