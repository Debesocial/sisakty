<?php
if (@$_GET['v'] == "dashboard") {
	include "dashboard.php";
} elseif (@$_GET['v'] == "setting") {
	include "setting.php";
} elseif (@$_GET['v'] == "visitor") {
	include "transact-visitor/transact-visitor.php";
} else {
	include "dashboard.php";
}?>

