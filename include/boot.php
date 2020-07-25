<?php

// boot.php
// This file loads our functions, the website configuration, and connects to the database.

// Show all errors and warnings on-page.
// TODO : Make this a config setting.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Load functions
require __DIR__ . "/functions.php";
require __DIR__ . "/dbhelpers.php";
require __DIR__ . "/templates.php";

// Load the website configuration.
$includedconfig = include __DIR__ . "/../config.php";
if (!$includedconfig) {
  die("<h1>Couldn't load the config file.</h1>");
}

// Start the session.
session_start();

// Conenct to the database.
// TODO : look for ways to make this variable more global.
$database = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// If we can't connect to the database, show an error message.
if ($database->connect_error) {
    die("<h1>An error occured connecting to the database :</h1><br>" . $database->connect_error);
}

// Set the character set for the database.
// TODO : is this really needed?
$database->set_charset("uf-8");
