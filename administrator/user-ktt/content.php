<?php 
// DASHBOARD
if (@$_GET['v'] == "dashboard") {
	include "dashboard.php";

// USER
} elseif (@$_GET['v'] == "muser") {
	include "master-user/master-user.php";

// MINEPRMIT
} elseif (@$_GET['v'] == "marea") {
	include "master-mine/master-area.php";

// SETTING
} elseif (@$_GET['v'] == "setting") {
	include "setting.php";

// TRANSACTION
} elseif (@$_GET['v'] == "hazard") {
	include "transact-hazard/transact-hazard.php";
} elseif (@$_GET['v'] == "mpermit") {
	include "transact-mine/transact-mpermit.php";
} elseif (@$_GET['v'] == "visitor") {
	include "transact-visitor/transact-visitor.php";

// ELSE
} else {
	include "dashboard.php";
}?>

