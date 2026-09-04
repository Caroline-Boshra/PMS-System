<?php
require_once dirname(__FILE__,3) . "/config.php";
require_once BASE_PATH ."core/functions.php";
require_once BASE_PATH ."core/validations.php";

session_unset();
session_destroy();

header("Location: " . BASE_URL . "views/auth/login.php");
