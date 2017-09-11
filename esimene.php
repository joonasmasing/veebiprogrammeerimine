<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Joonas Masing staff(esimene php vist)</title>
</head>
<body>
<h1>Joonas Masing</h1>
<p>See veebileht on loodud õppetöö raames ning ei sisalda tõsiseltvõetavat sisu.</p>
<p>This website is made for educational purposes only.</p>
<?php
echo "<p>Kõige esimene PHP abil väljastatud sõnum.</p>";
echo "<p>Täna on ";
echo date("d.m.Y");
echo ".</p>";
echo "<p>Lehe avamise hetkel oli " .date("H:i:s") .".</p>";
?>
</body>
</html>