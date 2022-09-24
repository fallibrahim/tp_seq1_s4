<?php 
session_start();
?>
<!doctype html>
<html lang="fr">
<head>
<title>titre page</title>
<meta charset utf-8/>
<style>
 p
 {
  color:red;
 }
 main
 { 
   position:absolute;
   top:40%;
   left:40%;
 }
 img{
   position : absolute;
   top:85px;
   left:170px;
   height:20px;
   cursor:pointer; 
 }
 input[type="password"]
 {
   height:30px;
   border-radius:5px;
 }
 input[type="text"]
 {
   height:30px;
   border-radius:5px;
  
 }
 input[type="email"]
 {
   height:30px;
   border-radius:5px;
  
 }
 input[type="submit"]
 {
   height:30px;
   width:178px;
   background-color:lightgreen;
   border-radius:5px;
   border:none;
 }
 .fondecran {
 /* Fixe l'image en haut à gauche de la page */
 position: fixed; 
 top: 0; 
 left: 0; 
 /* Préserve le ratio de l'image */
 min-width: 100%;
 min-height: 100%;
}
</style>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">
</head>
<body>
<img src=imageConnexion.jpg id=image class=fondecran alt="image"/>
<main>
<form method="POST" class="frm">
<fieldset>
<legend style="color:brown;">Page d'Authentification</legend>    
<input type="email" placeholder="email" name="email"/><br><br>
<div>
<input type="password" placeholder="Mot de passe" id="pass" name="Mdp"/>
<img src="black_eye.png" alt="eye" id="eye" onclick="changer()"/>
</div><br><br>
<input type="submit" value="Se connecter" name="submit">
</fieldset>
</form><br>
<span><a href="motPasseOublie.php" style="color:#694374;">Mot de passe oublié ?</a></span>
<script>
e=true;
function changer()
{
if(e)
{
document.getElementById("pass").setAttribute("type","text");
document.getElementById("eye").src="black_eye.png";
e=false;
}
else
{
document.getElementById("pass").setAttribute("type","password");
document.getElementById("eye").src="eye_masque.png";
e=true;
}
     
  }
</script>
<?php
$servername = "localhost";
$username = "newUsers";
$password = "password";
$dbname = "mabase";
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if(isset($_POST["submit"]))
{      
$userEmail = htmlspecialchars($_POST["email"]);
$userMdpp = $_POST["Mdp"];

$rechercherEmail = $conn->prepare('SELECT Email from etudiants where Email = ?'); 
$rechercherEmail->execute(array($userEmail));
$rechercheMotpass = $conn->prepare('SELECT mot_de_passe from etudiants where mot_de_passe = ?'); 
$rechercheMotpass->execute(array($userMdpp));
if($rechercherEmail->rowCount() > 0 && $rechercheMotpass->rowCount() > 0)
{
 $_SESSION['connexion'] = true;
 header("Location:admin.php");   
} 
elseif(empty($_POST["email"]) || empty($_POST["Mdp"]))
{
 echo "<p>Veuillez vous authentifier svp!</p>";     
}
else
{ 
 echo "<p>Login ou mot de passe incorrect!</p>";
}

} 
if (isset($_GET["msgg"]))
{
  echo "<p style='color:blue;'>Vous venez de vous déconnecter !</p>";
}
if (isset($_GET["msgHome"]))
{
  echo "<p style='color:blue;'>Vous etes déconnecté. Veuillez vous connecter svp!</p>";
} 
if (isset($_GET["msgAdmin"]))
{
  echo "<p style='color:blue;'>Vous etes déconnecté. Veuillez vous connecter svp!</p>";
}
?>
</main>
</body>
</html>
