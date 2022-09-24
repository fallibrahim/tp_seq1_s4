<?php
    session_start();  
?>
<!doctype html>
<html lang="fr">
<head>
  <title>Page accueil</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
 </head>
 <body>
 <?php include 'menu.php';?>
 <?php
    if($_SESSION['connexion'] == false)
    {
       header('location:index.php?msgHome=home');
    }  
?>
 <h1>Page d'accueil</h1>
 <a href="deconn.php">Se déconnecter</a><br><br>
 <a href="admin.php">Allez à la page admin du site</a>
 <p style="color:green;"><?php echo "Bienvenue à la page d'accueil du Site"?></p>
 </body>
</html>