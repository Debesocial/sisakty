<?php if (@$_GET['v'] == "dashboard") {
    include "dashboard.php";
} elseif (@$_GET['v'] == "login") {
    include "login.php";
} elseif (@$_GET['v'] == "forgot-password") {
    include "forgot-password.php";
} elseif (@$_GET['v'] == "achivement") {
    include "achivement.php";
} elseif (@$_GET['v'] == "faq") {
    include "faq.php";
} elseif (@$_GET['v'] == "bulletin") {
    include "bulletin.php";
} elseif (@$_GET['v'] == "iupdate") {
    include "iupdate.php";
} elseif (@$_GET['v'] == "hazard") {
    include "hazard.php";
} elseif (@$_GET['v'] == "hazard-user") {
    include "hazard-user.php";
} elseif (@$_GET['v'] == "hazard-report") {
    include "hazard-report.php";
} elseif (@$_GET['v'] == "hazard-pic") {
    include "hazard-pic.php";
} elseif (@$_GET['v'] == "hazard-detail") {
    include "hazard-detail.php";
} elseif (@$_GET['v'] == "hazard-detail-pic") {
    include "hazard-detail-pic.php";
} elseif (@$_GET['v'] == "profil") {
    include "profil.php";
} elseif (@$_GET['v'] == "bookmark") {
    include "bookmark.php";
} elseif (@$_GET['v'] == "notification") {
    include "notification.php";
} else {
    include "dashboard.php";
}
