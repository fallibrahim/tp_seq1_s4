<?php
  session_start(); 
?>
<!doctype html>
<html lang="fr">
    <head>
    <title>page admin</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style"/>
    <style>
          h1
          {
              color:green;
          }
    </style>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  </head>
    <body>
    <?php 
     if($_SESSION['connexion'] == false)
     {
       header('location:index.php?msgAdmin=admin');
     }  
    ?>
<?php include 'menu.php';?>
<?php
if(isset($_GET['insert']))
{
  echo "<p class='alert alert-success'>insertion effectuée avec succès!</p>";
}
?>
<?php
if(isset($_GET['mod']))
{
  echo "<p class='alert alert-success'>modification effectuée avec succès!</p>";
}
?>
<?php
  $servername = "localhost";
  $username = "newUsers";
  $password = "password";
  $dbname = "mabase";
  try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $req = $conn->prepare("SELECT * FROM etudiants");
  $req->execute();
  $donnee = $req->fetchAll();
  } catch(PDOException $e) {
   echo "Error: " . $e->getMessage();
  }
    $conn = null;
    $result = $donnee;
?>
 <p id="bienVenue">
 <?php include 'conn.php'; 'detail.php';
 echo "<h1 style='text-align:center;'>Bienvenue à la page d'administration du Site !</h1>";
 ?>
  </p>
  <table class="table table-striped">
  <thead> 
  <tr class="table-success">
  <th>Prenoms</th>
  <th>Noms</th>
  <th>Mot de passe</th>
  <th>Email</th>
  <th>Adresse</th>
  <th>Telephone</th>
  <th>Action 1</th>
  <th>Action 2</th>
  <th>Action 3</th>
  </tr>
  </thead>
  <tbody>
  <?php foreach($result as $resultat): ?>
  <tr> 
  <td><?= $resultat['prenoms'] ?></td>
  <td><?= $resultat['Noms'] ?></td>
  <td><?= $resultat['mot_de_passe'] ?></td>
  <td><?= $resultat['Email'] ?></td>
  <td><?= $resultat['Adresse'] ?></td>
  <td><?= $resultat['Telephone'] ?></td>
  <td><a href="supprimer.php?id=<?=$resultat['id']?>" onclick=" return confirm('Voullez vous vraiment supprimer l\'etudiant');"><button type="button" class="btn btn-danger">Supprimer</button></a></td>
  <td><a href="modifier.php?id=<?= $resultat['id']?>"><button type="button" class="btn btn-success">Modifier</button></a></td>
  <td><a href="detail.php?id=<?=$resultat['id']?>"><button type="button" class="btn btn-primary">Consulter</button></a></td>
  </tr>
  <?php endforeach ?>
  </tbody>
  </table>
    </body>   
</html>