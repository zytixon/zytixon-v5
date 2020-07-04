<?php

require __DIR__ . "/include/boot.php";

$_SESSION = array();

session_destroy();

redirect("/");
