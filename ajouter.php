<?php
  session_start(); 
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
<h1>Ajouter un Etudiant</h1>
  <form method="POST">
  <input type="text" name="prenom" placeholder="prenom" required><br><br>
  <input type="text" name="nom" placeholder="nom" required><br><br>
  <input type="password" name="mot_de_passe" placeholder="mot de passe" required><br><br>
  <input type="email" name="Email" placeholder="Email" required><br><br>
  <input type="text" name="Adresse" placeholder="Adresse" required><br><br>
  <input type="number" name="Telephone" placeholder="Telephone" required><br><br>
  <input type="submit" name="ajouter" value="Ajouter" class="btn btn-success">
 </form>
 <?php
 if(isset($_POST['ajouter']))
 {
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
     $rechercherEmail = $conn->prepare('SELECT Email from etudiants where Email = ?'); 
     $rechercherEmail->execute(array($email));
     if($rechercherEmail->rowCount()<= 0)
     {
     $_SESSION['insert'] = true;
     $req = $conn->prepare('INSERT INTO etudiants (prenoms,Noms,mot_de_passe,Email,Adresse,Telephone) values(:prenoms,:noms,:motPass,:email,:adresse,:tel)');
     $req->bindValue(":prenoms",$prenoms, PDO::PARAM_STR);
     $req->bindValue(":noms",$noms, PDO::PARAM_STR);
     $req->bindValue(":motPass",$motPass, PDO::PARAM_STR);
     $req->bindValue(":email",$email, PDO::PARAM_STR);
     $req->bindValue(":adresse",$adresse, PDO::PARAM_STR);
     $req->bindValue(":tel",$tel, PDO::PARAM_STR);
     $req->execute();
    header('location:admin.php?insert=alertInsert');
    }
    else
    {
       echo "<p class='alert alert-danger alert-dismissible' style='width:20%;margin-top:2%;'>l'Adresse Email existe déjà<button type='button' class='btn-close' data-bs-dismiss='alert'></button></p>";
    } 
 }
?>
</body>
</html>