<?php
	session_start();

	if(isset($_GET["brick"])) {
		if (($_GET["brick"]) > 4) {
			return;
		}

		$brick_type = $_GET["brick"];
		if (isset($_SESSION['items'])) {
			if (!isset($_SESSION['items'][$brick_type])) {
				$_SESSION['items'][$brick_type] = 0;
			}
			$_SESSION['items'][$brick_type]++; 
		} else {
			$_SESSION['items'] = array_fill(0, 5, 0);
			if (!isset($_SESSION['items'][$brick_type])) {
				$_SESSION['items'][$brick_type] = 0;
			}
			$_SESSION['items'][$brick_type]++;
		}
	}

	header('Location:./index.php');
?>