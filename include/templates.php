<?php
// templates.php
// TODO: FInd a description.

// Template for a room in the rooms list.
function tpl_roomslist_room($channel) {
    echo "<a href=\"#\" class=\"sidebar__item sidebar__nav-item\"><span class=\"iconify\"
                        data-icon=\"mdi:pound\"></span>{$channel['name']}</a>\n";
}
