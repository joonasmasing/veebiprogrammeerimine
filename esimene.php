<?php
//muutujad
$myName = "Joonas";
$myFamilyName = "Masing";
$hourNow = date("H"); 
$schooldaystart = date("d.m.Y") ." " ."8.15";
//echo $schooldaystart
$schoolbegin = strtotime($schooldaystart);
//echo $schoolbegin
$timeNow = strtotime("now");
//echo ($timeNow - $schoolbegin);
//echo $hourNow 
$minutespassed = round(($timeNow - $schoolbegin) / 60);
//echo $minutespassed;
//võrdlen kellaaega ja annan hinnangu, mis päeva osaga on tegemist (< > == <== >== . !=(ei ole võrdne))
$partOfday = "";
if ( $hourNow < 8 ){
	$partOfday = "varajane hommik";
}
//echo $partOfDay;
if( $hourNow >= 8 and $hourNow < 16 ) {
	$partOfday = "koolipäev";
}
if ( $hourNow >= 16 ) {
	$partOfday = "vaba aeg";
}

//vanusega seotud muutujad
$myage = 0;
$ageNote = "";
$myBirthYear;
$yearsOfMyLife = "";
$monthNamesEt = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];

//var_dump($monthNamesEt);

//echo $monthNamesEt[3];
$monthNow = $monthNamesEt[date("n") - 1];

 //var_dump($_POST);
 //echo $_POST;
 //echo $_POST["birthYear"];
 
 //arvutame vanuse
 if (isset ($_POST["birthYear"]) and$_POST["birthYear"] != 0){
	 $myBirthYear = $_POST["birthYear"];
 $myAge = date("Y") - $myBirthYear;
 //echo $myAge;
 $ageNote = "<p>Te olete umbes " .$myAge ." aastat vana.</p>";
 
 $yearsOfMyLife = "<ol> \n"; 
 $yearNow = date("Y");
 for ($i = $myBirthYear; $i <= $yearNow; $i ++){
	 $yearsOfMyLife .= "<li>" .$i ."</li> \n";
 }
 $yearsOfMyLife .= "</ol> \n";

 }
 
 
 //lihtne tsükkel
 /*
 
 for ($i = 0; $i < 5; $i ++){
	 echo "ha";
	 } 

 */
 
 
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Joonas Masing - veebiprogrammeerimine</title>
</head>
<body>
<h1>
<?php
echo $myName ." " .$myFamilyName;
?>
</h1>
<p>See veebileht on loodud õppetöö raames ning ei sisalda tõsiseltvõetavat sisu.</p>
<p>This website is made for educational purposes only.</p>
<?php
echo "<p>Kõige esimene PHP abil väljastatud sõnum.</p>";
echo "<p>Täna on ";
echo date("d. ") .$monthNow .date(" Y") .", käes on " .$partOfday;
echo ".</p>";
echo "<p>Lehe avamise hetkel oli " .date("H:i:s") .".</p>";
?>
<h2>Räägime vanusest</h2>
<p>Sisesta oma sünniaasta, arvutame vanus!</p>
<form method="POST">
<label>Teie sünniaasta: </label>
<input name="birthYear" id="birthYear" type="number" min="1900" max="2017" value="<?php echo $myBirthYear; ?>">

<input id="submitBirthYear" type="submit" value="Kinnita">

</form>
<?php
if ($ageNote != ""){
	echo $ageNote;
}
if ($yearsOfMyLife !="") {
	echo "\n <h3>Olete elanud järgmistel aastatel</h3> \n" . $yearsOfMyLife;
}
?>
</body>
</html>


