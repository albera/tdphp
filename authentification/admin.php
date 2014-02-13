<?php
// On prolonge la session
session_start(); 

// On teste si la variable de session existe et contient une valeur
if(empty($_SESSION['login']))
  { // Si inexistante ou nulle, on redirige vers le formulaire de login
   header('Location: auth1.php');
    exit();
  }
 else {
   require_once('Auth.php');
   require_once('connect.php');
   $utilisateur=$_SESSION['login'];
   // on teste si l'on n'a pas depasse le temps de session
   $timeout=120;
   $session=new Auth(SERVER,BASE,USER,PASSWD,$timeout);
   //$session->lire_info($utilisateur); 
   echo  "<h1>Bienvenue ".$_SESSION['login']."</h1>";
 }
?>

<html><head>
<meta charset="utf-8">
<title>Administration</title>
</head> 
<body>
	<fieldset>
	<legend>Ajout Planning</legend>
<input type="button" value="Ajout de Planning" onclick=
"document.location.replace('Ajout_Planning.php')">
	<legend>Liste Planning</legend>
<input type="button" value="Liste de Planning" onclick=
"document.location.replace('Liste_Planning.php')">
	<legend>Ajouter une activité</legend>
	
<input type="button" value="Ajout d'activite" onclick=
"document.location.replace('Ajouter_Activite.php')">
	<legend>Fin de la session</legend>	
	
<input type="button" value="Deconnexion" onclick=
"document.location.replace('deconnexion.php')">
	</fieldset>
</body>
</html>
