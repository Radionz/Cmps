<?php
// Start the session
session_start();

require_once 'dbaccess.php';

if (isset($_POST)) {
	$sql = 'SELECT * FROM "User" WHERE id=?';
	$q = $db->prepare($sql);
	$q->execute(array($_POST["id"]));

	$row = $q->fetch();
	$arr = array('latitude' => $row['latitude'],
		'longitude' => $row['longitude'],
		'orientation' => $row['orientation'],
		'name' => $row['name']);
	echo json_encode($arr);
}
