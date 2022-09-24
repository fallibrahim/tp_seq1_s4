<?php
    session_start(); 
    if(!$_SESSION['connexion'])
    {
       header('location:index.php');
    }  
?><!doctype html>
<html lang="fr">
<head>
<title>detailPHP</title>
<meta rel="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<table class="table">
<thead>  
<tr>
    <th>ID</th>
    <th>Prenoms</th>
    <th>Noms</th>
    <th>Mot de passe</th>
    <th>Email</th>
   <th>Adresse</th>
   <th>Telephone</th>
</tr>
</thead>
<tbody>
<?php include 'menu.php';?>
<?php
$idParametre = $_GET['id'];
if ($idParametre){
  header("location:admin.php");
}
  try
  {
  $servername = "localhost";
  $username = "newUsers";
  $password = "password";
  $dbname = "mabase";
  $conn2 = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = $conn2->prepare('DELETE from etudiants where id = :idParametre');
  $sql->bindValue(":idParametre",$idParametre); 
  $sql->execute();
  }catch(PDOException $e)
  {
    echo "Erreur" .$e->getMessage();
  }
 ?>
</tbody>
</table> 
</body>
</html>