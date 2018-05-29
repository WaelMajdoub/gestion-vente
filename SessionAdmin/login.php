<?php

$login_valide = "admin";
$pwd_valide = "admin";


if (isset($_POST['login']) && isset($_POST['pwd'])) {


	if ($login_valide == $_POST['login'] && $pwd_valide == $_POST['pwd']) {

		session_start ();

		$_SESSION['login'] = $_POST['login'];
		$_SESSION['pwd'] = $_POST['pwd'];

		header ('location:gestion.php');
	}
	else {

		echo '<body onLoad="alert(\'Admin non reconnu...\')">';

		echo '<meta http-equiv="refresh" content="0;xURL=../index.php">';
	}
}
else {
	echo 'Verifier les champs.';
}
?>