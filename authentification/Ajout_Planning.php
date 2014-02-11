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

$idrequete="SELECT iduser FROM USER where username = '".$_SESSION['login']."';";
//$idlogin=mysql_query($idrequete);
//$idresult=mysql_result($idlogin,0);
$reponse = $connexion -> query( $idrequete );
$d = $reponse -> fetch();
echo "<p>User : ".$d['iduser']."</p>";

$s1="select * from PLANIFIER where iduser=:l and JJ/MM/AAAA=:j and heure=:h";
$t1=$connexion->prepare($s1);
$t1->bindParam(':l',$idresult);
$t1->bindParam(':j',$_POST['date']);
$t1->bindParam(':h',$_POST['heure']);
$t1->execute();
echo "<p>Num de ligne test requete date/user : ".$t1->rowCount()."</p>";

//if($t1->rowCount()==0){
  $sql="INSERT INTO PLANIFIER (iduser, idact, heure, JJ/MM/AAAA) values(:log, :act, :hour, :date)";
  $stmt=$connexion->prepare($sql);
  $stmt->bindParam(':log',$d['user']);
  $stmt->bindParam(':act',$_POST['activite']);
  $stmt->bindParam(':hour',$_POST['heure']);
  $stmt->bindParam(':date',$_POST['date']);
  $stmt->execute();
  echo "Ajouté \n";
//}

echo "<li>".$_POST['activite']."</li>";
echo "<li>".$_POST['heure']."</li>";
echo "<li>".$_POST['date']."</li>";

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
