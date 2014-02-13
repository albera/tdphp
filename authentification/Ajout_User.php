<?php

require_once('modele.php');

$connexion = db_connect(); 



	

if ( !empty($_POST['username']) && !empty($_POST['password'])) {
	$idrequete="SELECT count(*) as nb FROM USER where username = '".$_POST['username']."';";
	$reponse = $connexion -> query( $idrequete );
	$d = $reponse -> fetch();
	if ( $d['nb'] != 0 ) { 
		echo "<p>Ce username est déja utilisé. Veuillez recommencer !</p>";
	}
	else {
		$insert = "INSERT INTO USER (username, password) values(:u,:p)"; 
		$stmt = $connexion -> prepare($insert); 
		$stmt ->bindParam (':u',$_POST['username']);
		$stmt ->bindParam (':p',md5($_POST['password']));
		$stmt -> execute();
		echo "<p>Vous êtes enregistrer !</p>";
	}
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
<label for="username">Nom utilisateur : </label>
<input type="text" name="username" required />
</p>

 <p>
<label for="Password">Password : </label>
<input type="password" name="password" required />
</p>

<p>
<input type="submit" name="submit" value="Enregistrer"/>
</p>


</form>
</body>
<a href = "auth1.php">Retour au menu principal</a>
</html>


