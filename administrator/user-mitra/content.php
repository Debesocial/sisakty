<?php if (@$_GET['v'] == "dashboard") {
	include "dashboard.php";

// USER
} elseif (@$_GET['v'] == "muser") {
	include "master-user/master-user.php";
} elseif (@$_GET['v'] == "mlevel") {
	include "master-user/master-level.php";
} elseif (@$_GET['v'] == "mdepartement") {
	include "master-user/master-departement.php";
} elseif (@$_GET['v'] == "mdivisi") {
	include "master-user/master-divisi.php";
} elseif (@$_GET['v'] == "mcompany") {
	include "master-user/master-company.php";

// USER
} elseif (@$_GET['v'] == "mbulletin") {
	include "master-bulletin/master-bulletin.php";
} elseif (@$_GET['v'] == "miupdate") {
	include "master-bulletin/master-iupdate.php";

// HAZARD
} elseif (@$_GET['v'] == "mclassification") {
	include "master-hazard/master-classification.php";
} elseif (@$_GET['v'] == "mlocation") {
	include "master-hazard/master-location.php";
} elseif (@$_GET['v'] == "mrisk") {
	include "master-hazard/master-risk.php";


// SIMPERMIT
} elseif (@$_GET['v'] == "munit") {
	include "master-sim/master-unit.php";

// SETTING
} elseif (@$_GET['v'] == "setting") {
	include "setting.php";

// TRANSACTION
} elseif (@$_GET['v'] == "mpermit") {
	include "transact-mine/transact-mpermit.php";
} elseif (@$_GET['v'] == "spermit") {
	include "transact-sim/transact-spermit.php";
} elseif (@$_GET['v'] == "hazard") {
	include "transact-hazard/transact-hazard.php";
} elseif (@$_GET['v'] == "detail") {
	include "transact-hazard/transact-hazard-detail.php";
} else {
	include "dashboard.php";
}?>

