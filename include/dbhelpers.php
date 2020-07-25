<?php
// dbhelpers.php
// Helper functions for not writing four lines every time we get something from the db.

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
                "name" => $row["name"]
            );
        }
    } else {
        return false;
    }
    return $rooms;
}
