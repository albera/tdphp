<?php
$message="";
require_once('admin.php');
/* if(!empty ($_POST)){ */
/*   $dbh="mysql:dbname=".BASE.";host=".SERVER; */
/*   $m=array(array('Planning' => $_POST[])) */
/*   $insert="INSERT INTO PLANIFIER (Planning,iduser,idact,JJ/MM/AAAA,heure) VALUES (:p,:u,:a,:j,:h)"; */
/*   $stmt = $dbh -> prepare($insert); */
/*   $stmt -> bindParam( */
/*   $message='Plannification ajoutée';  */
/*   } */
?>

<!doctype html>
<head>
<meta charset="utf-8">
<title>Planning </title>
</head>
<body>
<form action=
"<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<fieldset>
<?php
// Rencontre-t-on une erreur ?
if(!empty($message))
echo '<p>', htmlspecialchars($message) ,'</p>';
?>

 <p>
<label for="Liste">Liste :</label>
<select name="Liste" id="Liste">
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
 
 
$reponse = $bdd->query('SELECT * FROM PLANIFIER');
 
while ($donnees = $reponse->fetch())
{
?>
  <option value="Planning :"> <?php echo $donnees['Planning']," ", $donnees['iduser']," ", $donnees['idact']," ", $donnees['JJ/MM/AAAA']," ", $donnees['heure']; ?></option>
<?php
}
 
$reponse->closeCursor();

?>
</select>
</p>
</fieldset>
</form> 
</body>
</html>
