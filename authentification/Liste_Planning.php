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
<?php
// Rencontre-t-on une erreur ?
if(!empty($message))
echo '<p>', htmlspecialchars($message) ,'</p>';
?>

<?php
$bdd = db_connect(); 
 
 
$reponse = $bdd->query('SELECT * FROM PLANIFIER');
 
while ($donnees = $reponse->fetch())
{
?>
<?php echo "<li>L'utilisateur ".$donnees['iduser']." a plannifié l'activité ".$donnees['idact']." à la date ".$donnees['JJ/MM/AAAA']." ".$donnees['heure']; ?>
<?php
}
 
$reponse->closeCursor();

?>
</body>
</html>
