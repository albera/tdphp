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
function Username ($a) {
	$bdd = db_connect(); 
	$idrequete="SELECT `username` FROM USER where iduser = '".$a."'";
	$reponse = $bdd -> query( $idrequete );
	$d = $reponse -> fetch();
	return $d['username'];
	
}

function Activity ($a) {
	$bdd = db_connect(); 
	$idrequete1="SELECT `actname` FROM ACTIVITE where idact = '".$a."'";
	$reponse1 = $bdd -> query( $idrequete1 );
	$da = $reponse1 -> fetch();
	return $da['actname'];
	
}




 $bdd = db_connect(); 
 
$reponse = $bdd->query('SELECT * FROM PLANIFIER');
 
while ($donnees = $reponse->fetch())
{	
	$a = Activity ($donnees['idact']);
	$u = Username ($donnees['iduser']);	
	
	echo "<p>".$u." a plannifié l'activité ".$a." à la date ".$donnees['JJ/MM/AAAA']." à ".$donnees['heure']."H</p>";
}
 
$reponse->closeCursor();

?>
</body>
</html>
