<?php

$namecheck = "/^[A-Za-zÀ-ÿ]{3,21}$/";

if (preg_match($namecheck, $_POST["name"])) {
    if ($err = create_room(sanitize_input($_POST["name"]),
    sanitize_input($_POST["privacylevel"]))) {
        die($err);
    }
    redirect(".");
} else {
    echo "The room name is invalid.";
}
