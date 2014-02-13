<?php
$message="";
require_once('admin.php');
require_once('modele.php');

?>


<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Planning </title>
</head>
<body>
<form action="Ajout_Planning.php" method="post">
<fieldset>
<?php
// Rencontre-t-on une erreur ?
if(!empty($message))
echo '<p>', htmlspecialchars($message) ,'</p>';
?>

 <p>
<label for="activite">Activite :</label>
<select name="activite" id="activite">
<?php
  $dsn="mysql:dbname=".BASE.";host=".SERVER;
try
{
        $bdd = new PDO($dsn, USER, PASSWD);
}
catch(Exception $e)
{
            die('Erreur : '.$e->getMessage());
}
 
 
$reponse = $bdd->query('SELECT * FROM ACTIVITE');
 
while ($donnees = $reponse->fetch())
{
?>
  <option value="<?php echo $donnees['idact']; ?>"> <?php echo $donnees['idact']," ", $donnees['actname']; ?></option>
<?php
}
 
$reponse->closeCursor();
 
?>
</select>
</p>

<p>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<datepicker type="grid" value="YYYY/MM/DD">
<script>
$(function() {
$( "#datepicker" ).datepicker();
$( "#datepicker" ).datepicker("option","dateFormat","yy-mm-dd");
});
</script>

<p>Date: <input type="text" name="date" id="datepicker"></p>
</select>

<label for="heure">Heure :</label>
<select name="heure" id="heure">
<option value=8>8</option>
<option value=9>9</option>
<option value=10>10</option>
<option value=11>11</option>
<option value=12>12</option>
<option value=13>13</option>
<option value=14>14</option>
<option value=15>15</option>
<option value=16>16</option>
<option value=17>17</option>
<option value=18>18</option>
<option value=19>19</option>
<option value=20>20</option>
</select>
</p>

<br/>
<input type="submit" name="submit" value="valider"/>
</p>
</fieldset>
</form> 
</body>
</html>

<?php

$connexion = db_connect();

// Requête récupérant l'identifiant du l'utilisateur
$idrequete="SELECT iduser FROM USER where username = '".$_SESSION['login']."';";
$reponse = $connexion -> query( $idrequete );
$id = $reponse -> fetch();


if ( !empty($_POST['heure']) && !empty($_POST['date']) && !empty($_POST['activite']) ) {
$idrequete="SELECT count(*) as nb FROM `PLANIFIER` WHERE `JJ/MM/AAAA`= ".$_POST['date']." and `heure` = ".$_POST['heure']."";
echo "SELECT count(*) as nb FROM `PLANIFIER` WHERE `JJ/MM/AAAA`= '".$_POST['date']."' and `heure` = '".$_POST['heure']."'";
$reponse = $connexion -> query( $idrequete );
$d = $reponse -> fetch();
if ( $_POST['date'] == '2014-02-01' )
	echo $d['nb'];
if ( $d['nb'] != 0 ) { 
	echo "<p>Il y a déjà une activité prévue dans ces horaires </p>";
}
else {
  mysql_query("INSERT INTO PLANIFIER values('','".$id['iduser']."','".$_POST['activite']."','".$_POST['date']."','".$_POST['heure']."')");
  echo "Ajouté \n";	
echo "<li>".$id['iduser']."</li>";
echo "<li>".$_POST['activite']."</li>";
echo "<li>".$_POST['heure']."</li>";
echo "<li>".$_POST['date']."</li>";
//}
}
}
?>
