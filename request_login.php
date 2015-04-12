<?php
// Start the session
session_start();

if(isset($_POST)){
	$_SESSION['login'] = $_POST['login']
	echo "ok";
}

?>