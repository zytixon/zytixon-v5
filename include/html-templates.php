<?php
// html-templates.php
// HTML templates with the <template> tag, for elements shown later by JavaScript.
// Not to mistake with include/templates.php.
?>

<template class="js-add-room-tpl">
    <div class="modal-box add-room-modal js-add-room-modal">
        <form action="">
            <label for="add-room-input">
                <span class="iconify add-room-modal__icon" data-icon="mdi:pound"></span>
            </label>
            <input type="text" placeholder="Enter a room ID" class="text-input add-room-modal__input js-add-room-input"
                id="add-room-input">
        </form>
        <div class="add-room-modal__info js-add-room-info">
            We'll try to find a room with this ID. If it doesn't exist, you'll be prompted to create it.
        </div>
    </div>
</template>