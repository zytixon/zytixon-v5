<?php
// database.php
// Functions for the database (like the model in model-view-controller)

// Get the user's tag from its ID.
function get_user_tag_from_id($id)
{
    global $database;

    if (!$stmt = $database->prepare("SELECT tag FROM users WHERE id = ?")) {
        die("<h1>An error occured.</h1>");
    }
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["tag"];
    }
}

// Get the specified user's channels.
function get_user_channels($id)
{
    global $database;

    if (!$stmt = $database->prepare("SELECT user_room_relationship.room_id,
            rooms.name
        FROM user_room_relationship
        INNER JOIN rooms ON rooms.id = user_room_relationship.room_id
        WHERE user_id = ?;")) {
        die("<div class=\"sidebar__item\">An error occured getting your rooms.</div>");
    }
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $rooms = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $rooms[] = array(
                "id" => $row["room_id"],
                "name" => $row["name"],
            );
        }
    } else {
        return false;
    }
    return $rooms;
}

// Create a room (if it doesn't exist)
function create_room($name, $privacy_level)
{
    global $database;

    // Check if the room exists.
    if (!$stmt = $database->prepare("SELECT name FROM rooms WHERE `name` = ?")) {
        die("<h1>An error occured.</h1>");
    }
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();
    if (!$result->num_rows > 0) {
        // It doesn't, create it.
        if (!$stmt = $database->prepare("INSERT INTO rooms
            VALUES (NULL, ?, ?, '', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)")) {
            die("<h1>An error occured.</h1>");
        }
        $stmt->bind_param("ss", $name, $privacy_level);
        if (!$stmt->execute()) {
            die("<h1>An error occured.</h1>" . $database->error);
        }
        $lastinserted = $database->insert_id;

        // And add the current user to it as owner.
        if (!$stmt = $database->prepare("INSERT INTO user_room_relationship VALUES (?, ?, 2, 4, CURRENT_TIMESTAMP)")) {
            die("<h1>An error occured.</h1>");
        }
        $stmt->bind_param("ii", $_SESSION["id"], $lastinserted);
        if (!$stmt->execute()) {
            die("<h1>An error occured.</h1>" . $database->error);
        }
    }
    else {
        return "Room already exists.";
    }
}
