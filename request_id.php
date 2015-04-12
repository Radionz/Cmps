<?php
// Start the session
session_start();

if (isset($_SESSION['id'])) {
	echo $_SESSION['id'];
}