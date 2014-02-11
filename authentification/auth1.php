<?php
session_start();
$message="";
require_once('Auth.php');
require_once('connect.php');
// Les identifiants sont-ils  transmis ?
if(!empty ($_POST)){ 
  $session=new Auth(SERVER,BASE,USER,PASSWD,60);
  if($session->AuthUser($_POST['login'],$_POST['password'])){
	$message='Authentification reussie'; 
	header('Location: admin.php');
	exit();
      }
    else
      {
	// L'authentification a échoué
	$message=$session->Erreur_Message();
      }}?>

<!doctype html>
<head>
<meta charset="utf-8">
<title>Formulaire d\'authentification </title>
</head>
<body>
<form action=
"<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<fieldset>
<legend>Identifiez-vous</legend>
<?php
// Rencontre-t-on une erreur ?
if(!empty($message))
echo '<p>', htmlspecialchars($message) ,'</p>';
?>
 <p>
<label for="login">Login :</label>
<input type="text" name="login" id="login" value="" />
</p>
<p>
<label for="password">Password :</label>
<input type="password" name="password" id="password" value="" />
<br/>
<input type="submit" name="submit" value="valider"/>
</p>
</fieldset>
</form> 
</body>
</html>
