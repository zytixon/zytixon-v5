<?php

require __DIR__ . "/lib/boot.php";

$_SESSION = array();

session_destroy();

redirect("/");
