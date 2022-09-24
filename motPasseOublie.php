 <form method="POST">
<input type="email" placeholder="email" name="email"/><br><br>
<input type="submit" value="envoie un mot de passe aleatoire"/>
</form>
<?php
$servername = "localhost";
$username = "newUsers";
$password = "password";
$dbname = "mabase";
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if(isset($_POST["email"]))
{
    
}
?> 