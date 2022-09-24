<?php
    session_start(); 
 ?>
<?php
 if(isset($_POST['modifier']))
 {
    $idParametre = intval($_GET['id']);
     $prenoms = $_POST['prenom'];
     $noms = $_POST['nom'];
     $motPass = $_POST['mot_de_passe'];
     $email = $_POST['Email'];
     $adresse = $_POST['Adresse'];
     $tel = $_POST['Telephone'];

     $servername = "localhost";
     $username = "newUsers";
     $password = "password";
     $dbname = "mabase";
     $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $req = $conn->prepare('UPDATE etudiants SET prenoms =:prenoms, Noms=:noms, mot_de_passe=:motPass, Email=:email, Adresse=:adresse, Telephone=:tel where id=:idParametre');
     $req->bindValue(":prenoms", $prenoms, PDO::PARAM_STR);
     $req->bindValue(":noms", $noms, PDO::PARAM_STR);
     $req->bindValue(":motPass", $motPass, PDO::PARAM_STR);
     $req->bindValue(":email", $email, PDO::PARAM_STR);
     $req->bindValue(":adresse", $adresse, PDO::PARAM_STR);
     $req->bindValue(":tel", $tel, PDO::PARAM_STR);
     $req->bindValue(":idParametre", $idParametre, PDO::PARAM_STR);
     $req->execute();
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
<body include="admin.php">
<?php include 'menu.php';?>
<h1>Modifier l'information de l'etudiant</h1>
<?php 
    if(isset($_SESSION['connexion']) == false)
    {
       header('location:index.php');
    }  
?>
<?php
$idParametre = intval($_GET['id']);
 try
    {
    $servername = "localhost";
    $username = "newUsers";
    $password = "password";
    $dbname = "mabase";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $conn->prepare('SELECT * from etudiants where id = :idParametre');
    $sql->bindValue(":idParametre",$idParametre, PDO::PARAM_STR); 
    $sql->execute();
    $detail = $sql->fetchAll();
    }catch(PDOException $e)
    {
      echo "Erreur" .$e->getMessage();
    }
     $conn = null;
  ?>
  <?php foreach($detail as $aff) { ?>
  <form  method="POST">
  <input type="text" name="prenom" id="prenom" placeholder="prenom" value=<?php echo $aff['prenoms'];?>><br><br>
  <input type="text" name="nom" id="nom" placeholder="nom" value=<?php echo $aff['Noms'];?>><br><br>
  <input type="password" name="mot_de_passe" id="mot_de_passe" placeholder="mot de passe" value=<?php echo $aff['mot_de_passe'];?>><br><br>
  <input type="email" name="Email" id="Email" placeholder="Email" value=<?php echo $aff['Email']?>><br><br>
  <input type="text" name="Adresse" id="Adresse" placeholder="Adresse" value=<?php echo $aff['Adresse']?>><br><br>
  <input type="number" name="Telephone" id="Telephone" placeholder="Telephone" value=<?php echo $aff['Telephone']?>><br><br>
  <input type="submit" name="modifier" id="modifier" value="Mettre à jour" class="btn btn-success">
<?php  } ?>
 </form> 
 <?php 
 if(isset($_POST['modifier']))
 {
  header('location:admin.php?mod=modification');
 }
 ?>

</body>
</html>