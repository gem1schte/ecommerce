<?php

use App\Utils\Alert;

require_once __DIR__ . '/../../../core/init.php';
session_unset();
session_destroy();
Alert::success("Success", "Logout successful", ADMIN_URL . "views/login.php");
?>
