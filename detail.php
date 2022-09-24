<?php
    session_start(); 
    if(!$_SESSION['connexion'])
    {
       header('location:index.php');
    }  
?>
<!doctype html>
<html lang="fr">
<head>
<title>detailPHP</title>
<meta rel="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php include 'menu.php';?>
<table class="table table-striped">
<thead>  
<tr class="table-success">
    <th>Caractéristique</th>
    <th>Valeurs</th>
</tr>
</thead>
<tbody>
<?php
$idParametre = $_GET['id'];
  try
  {
  $servername = "localhost";
  $username = "newUsers";
  $password = "password";
  $dbname = "mabase";
  $conn1 = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password); $conn1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = $conn1->prepare('SELECT * from etudiants where id = :idParametre');
  $sql->bindValue(":idParametre",$idParametre); 
  $sql->execute();
  $detail1 = $sql->fetchAll();
  }catch(PDOException $e)
  {
    echo "Erreur" .$e->getMessage();
  }
   $conn1 = null;
   $recuperForid = $detail1;
  
 ?>
    <tr>
    <?php foreach($recuperForid as $getID1):?>
      <td>ID</td>
     <td><?= $getID1['id']?></td>
     <?php endforeach?>
    </tr>
    <tr>
     <?php foreach($recuperForid as $getID1):?>
     <td>Prénom</td>
     <td><?= $getID1['prenoms']?></td>
     <?php endforeach?>
     </tr>
     <tr>
     <?php foreach($recuperForid as $getID1):?>
     <td>Nom</td>
     <td><?= $getID1['Noms']?></td>
     <?php endforeach?>
     </tr>
     <tr>
     <?php foreach($recuperForid as $getID1):?>
     <td>Mot de passe </td>
     <td><?= $getID1['mot_de_passe']?></td>
     <?php endforeach?>
     </tr>
     <tr>
     <?php foreach($recuperForid as $getID1):?>
     <td>Email</td>
     <td><?= $getID1['Email']?></td>
     <?php endforeach?>
     </tr>
     <tr>
     <?php foreach($recuperForid as $getID1):?>
     <td>Adresse</td>
     <td><?= $getID1['Adresse']?></td>
     <?php endforeach?>
     </tr>
     <tr>
     <?php foreach($recuperForid as $getID1):?>
     <td>Téléphone</td>
     <td><?= $getID1['Telephone']?></td>
     <?php endforeach?>
    </tr> 
</tbody>
</table> 
</body>
</html>