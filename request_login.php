<?php
// Start the session
session_start();

require_once 'dbaccess.php';

if (isset($_POST) && !empty($_POST)) {
	$sql = 'INSERT INTO "User" (id, name) VALUES (DEFAULT, :name) RETURNING id';
	$q = $db->prepare($sql);
	$q->execute(array(':name' => $_POST["login"]));
	$row = $q->fetch();
	$arr = array('id' => $row['id']);
	$_SESSION['login'] = $_POST['login'];
	$_SESSION['id'] = $row['id'];
	echo json_encode($arr);
}