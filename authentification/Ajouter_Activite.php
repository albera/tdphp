<?php
require_once('admin.php');
require_once('modele.php');

$connexion = db_connect(); 

if ( !empty($_POST['nomact']) ) {
$insert = "INSERT INTO ACTIVITE (actname) values(:a)"; 
$stmt = $connexion -> prepare($insert); 
$stmt ->bindParam (':a',$_POST['nomact']);
$stmt -> execute();
  }
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Planning </title>
</head>
<body>
	
<form action=
"<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<?php
// Rencontre-t-on une erreur ?
if(!empty($message))
echo '<p>', htmlspecialchars($message) ,'</p>';
?>

 <p>
<label for="Liste">Ajouter activité :</label>
<input type="text" name="nomact"/>
</p>

<p>
<input type="submit" name="submit" value="Enregistrer"/>
</p>


</form>

</html>
