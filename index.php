<?php

require __DIR__ . "/include/boot.php";
?>

<html class="style--dev">

<head>
    <?php require __DIR__ . "/partials/head.php";?>
    <title>Zytixon</title>
</head>

<body>
    <div class="sidebar app-left-sidebar">
        <nav class="sidebar__nav">
            <a href="#" class="sidebar__item sidebar__nav-item sidebar__nav-item--active"><span class="iconify"
                    data-icon="mdi:compass"></span>Explore</a>
            <a href="#" class="sidebar__item sidebar__nav-item"><span class="iconify" data-icon="mdi:add"></span>Create
                or join a room</a>
            <hr>
            <div class="js-channels-list">
                <a href="#" class="sidebar__item sidebar__nav-item"><span class="iconify"
                        data-icon="mdi:pound"></span>general</a>
                <a href="#" class="sidebar__item sidebar__nav-item"><span class="iconify"
                        data-icon="mdi:pound"></span>dev</a>
                <a href="#" class="sidebar__item sidebar__nav-item"><span class="iconify"
                        data-icon="mdi:pound"></span>french</a>
                <a href="#" class="sidebar__item sidebar__nav-item"><span class="iconify"
                        data-icon="mdi:pound"></span>deutsch-jaaaa</a>
            </div>
        </nav>
        <div class="sidebar__item sidebar__item--bottom sidebar__user">
            <img src="/assets/images/default-avatar.png" alt="Your avatar" class="avatar avatar--away">
            <div>
                <p class="sidebar__user-tag">koioDesigns</p>
                <div class="sidebar__user-status-wrapper">
                    <select name="user-status" class="sidebar__user-status-select">
                        <option value="online">Online</option>
                        <option value="away" selected>Away</option>
                        <option value="dnd">Do Not Disturb</option>
                        <option value="invisble">Invisble</option>
                    </select>
                    <span class="iconify sidebar__user-status-select-icon" data-icon="mdi:menu-up"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="chat">
        <div class="chat__bottom">
            <div class="chat__message-input-wrapper">
                <input type="text" class="text-input chat__message-input"
                    placeholder="Write something nice and cool...">
            </div>
            <button class="btn btn--primary btn--square chat__send-btn">
                <span class="iconify" data-icon="mdi:arrow-up"></span>
            </button>
        </div>
    </div>
    <div class="sidebar room-sidebar"></div>
</body>

</html>