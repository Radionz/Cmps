<?php
// Start the session
session_start();

require_once 'dbaccess.php';

if (isset($_POST) && !empty($_POST)) {
	$sql = 'UPDATE "User" SET latitude=?, longitude=?, orientation=? WHERE id=?';
	$q = $db->prepare($sql);
	$q->execute(array($_POST["latitude"],$_POST["longitude"],$_POST["orientation"],$_POST["id"]));
}

$sql = 'SELECT * FROM "User"';
$q = $db->prepare($sql);
$q->execute();

$users = $q->fetchAll();
$arr = array();

foreach ($users as $row) {
	$arr[] = array('id'=>$row['id'],
		'name'=>$row['name'],
		'connected'=>$row['connected']);
}

echo json_encode($arr);
