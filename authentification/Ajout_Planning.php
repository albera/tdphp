<?php
$message="";
require_once('admin.php');
$dsn="mysql:dbname=".BASE.";host=".SERVER;
try{
  $connexion=new PDO($dsn,USER,PASSWD);
}
catch(PDOException $e){
  printf("echec de la connexion : %s\n", $e->getMessage());
  exit();
}

$s1="select * from PLANIFIER where login=:l and JJ/MM/AAAA=:j and heure=:h";
$t1=$connexion->prepare($s1);
$t1->bindParam(':l',$_SESSION['login']);
$t1->bindParam(':j',$_POST['datepicker']);
$t1->bindParam(':h',$_POST['heure']);
$t1->execute();

if($t1->rowCount()==0){
$sql="INSERT INTO PLANIFIER (iduser, idact, heure, JJ/MM/AAAA) values(:log, :name, :hour, :date)";
$stmt=$connexion->prepare($sql);
$stmt->bindParam(':log',$_SESSION['login']);
$stmt->bindParam(':name',$_POST['activite']);
$stmt->bindParam(':hour',$_POST['heure']);
$stmt->bindParam(':date',$_POST['datepicker']);
$stmt->execute();
}

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
  <option value="activitee :"> <?php echo $donnees['idact']," ", $donnees['actname']; ?></option>
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
<p>Date: <input type="text" id="datepicker"></p>
</select>

<label for="heure">Heure :</label>
<select name="heure" id="heure">
<option value="1">8</option>
<option value="2">9</option>
<option value="3">10</option>
<option value="4">11</option>
<option value="5">12</option>
<option value="6">13</option>
<option value="7">14</option>
<option value="8">15</option>
<option value="9">16</option>
<option value="10">17</option>
<option value="11">18</option>
<option value="12">19</option>
<option value="13">20</option>
</select>
</p>

<br/>
<input type="submit" name="submit" value="valider"/>
</p>
</fieldset>
</form> 
</body>
</html>
