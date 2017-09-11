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
echo $minutespassed;
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
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Joonas Masing staff(esimene php vist)</title>
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
echo date("d.m.Y") .", käes on " .$partOfday;
echo ".</p>";
echo "<p>Lehe avamise hetkel oli " .date("H:i:s") .".</p>";
?>
</body>
</html>