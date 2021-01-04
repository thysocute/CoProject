<?php
	if (!isset($_SESSION["account"])){
		header("Location: ../static/login.php");
	}
	
?>