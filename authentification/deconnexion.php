<?php
  // On prolonge la session
session_start(); 

// On teste si la variable de session existe et contient une valeur
if(empty($_SESSION['login']))
  { // Si inexistante ou nulle, on redirige vers authClasseBase.php
    header('Location: admin.php');
    exit();
  }
 else {
   require_once('Auth.php');
   require_once('connect.php');
   $utilisateur=$_SESSION['login'];
   $session=new Auth(SERVER,BASE,USER,PASSWD,0);
   $session->fin_session();
   
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>deconnexion</title>
</head>
<body>
   <H1>Vous êtes deconnecté!!!</H1>
  <p>
   <?php echo "Au revoir ".$utilisateur."<p>";?>
  </p>
	<fieldset>
	<legend>Retour</legend>
<input type="button" value="Retour" onclick=
"document.location.replace('auth1.php')">
	</fieldset>
</body>
</html>
<?php
   }
?>
