<?php
// Remove useless whitespace, backslashes and escape html-like characters.
function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Redirect the user to a given URL.
function redirect($location)
{
    header("Location: $location");
    exit();
}

// Returns the result of an SQL query.
function sql_get($query) {
	
}
