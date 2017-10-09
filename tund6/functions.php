<?php
	require("config.php");
	$database = "if17_masijoon_2";
	//alustamse sessiooni
	session_start();
	
	function signIn($email, $password){
		$notice = "";
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("SELECT id, email, password FROM vpusers WHERE email = ?");
		$stmt->bind_param("s", $email);
		$stmt->bind_result($id, $emailFromDb, $passwordFromDb);
		$stmt->execute();
		
		//kui vähemalt üks tulemus
		if ($stmt->fetch()){
			$hash = hash("sha512", $password);
			if($hash == $passwordFromDb){
				$notice = "Sisselogitud!";
				
				//määran sessioonimuutujaid
				$_SESSION["userId"] = $id;
				$_SESSION["userEmail"] = $emailFromDb;
				
				//lähen pealehele
				header("Location: main.php");
				exit();
				
			} else {
				$notice = "Vale salasõna!";
			}
		} else {
			$notice = "Sellise e-postiga kasutajat pole!";
		}
		
		$stmt->close();
		$mysqli->close();
		return $notice;
	}
	
	function signUp($signupFirstName, $signupFamilyName, $signupBirthDate, $gender, $signupEmail, $signupPassword){
		//loome andmebaasiühenduse
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		//valmistame ette käsu andmebaasiserverile
		$stmt = $mysqli->prepare("INSERT INTO vpusers (firstname, lastname, birthday, gender, email, password) VALUES (?, ?, ?, ?, ?, ?)");
		echo $mysqli->error;
		//s - string
		//i - integer
		//d - decimal
		$stmt->bind_param("sssiss", $signupFirstName, $signupFamilyName, $signupBirthDate, $gender, $signupEmail, $signupPassword);
		//$stmt->execute();
		if ($stmt->execute()){
			echo "\n Õnnestus!";
		} else {
			echo "\n Tekkis viga : " .$stmt->error;
		}
		$stmt->close();
		$mysqli->close();
	}

	//hea mõtte salvestamise funktsioon
	function saveIdea($idea, $color){
		$notice = "";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("INSERT INTO vpuserideas (userid, idea, ideacolor) VALUES(?, ?, ?)");
		echo $mysqli->error;
		$stmt->bind_param("iss", $_SESSION["userId"], $idea, $color);
		if($stmt->execute()){
			$notice = "Mõte on salvestatud!";
		} else {
			$notice = "Salvestamisel tekkis tõrge: " .$stmt->error;
		}
		
		$stmt->close();
		$mysqli->close();
		return $notice;
	}
	
	function readAllIdeas(){
		$ideas = "";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		//$stmt = $mysqli->prepare("SELECT idea, ideacolor FROM vpuserideas"); //KÕIK ASJAD
		//$stmt = $mysqli->prepare("SELECT idea, ideacolor FROM vpuserideas WHERE userid = ?");
		$stmt = $mysqli->prepare("SELECT idea, ideacolor FROM vpuserideas WHERE userid = ? ORDER BY id DESC");
		$stmt->bind_param("i", $_SESSION["userId"]);
		$stmt->bind_result($idea, $color);
		$stmt->execute();
		while ($stmt->fetch()) {
			$ideas .= '<p style="background-color: ' .$color .'">' .$idea ."</p> \n";
		}
		
		$stmt->close();
		$mysqli->close();
		return $ideas;
	}
	
	function readLastIdea(){
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("SELECT idea FROM vpuserideas WHERE id = (SELECT MAX(id) FROM vpuserideas)");
		$stmt->bind_result($idea);
		$stmt->execute();
		$stmt->fetch();
		$stmt->close();
		$mysqli->close();
		return $idea;
	}
	
	//sisestuse kontrollimise funktsioon
	function test_input($data){
		$data = trim($data);//liigsed tühikud, TAB, reavahetuse jms
		$data = stripslashes($data);//eemaldab kaldkriipsud "\"
		$data = htmlspecialchars($data);
		return $data;
	}
?>