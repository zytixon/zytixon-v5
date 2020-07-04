<?php

require __DIR__ . "/include/boot.php";

if (isset($_SESSION["tag"])) {
    echo "Tu es connecté en tant que " . $_SESSION["tag"];
    echo "<br>Tu peux <a href='/logout.php'>te déconnecter</a>";
} else {
    echo "Tu n'es pas connecté.";
}
