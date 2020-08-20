// Helpers.
$ = document.querySelector.bind(document);
$a = document.querySelectorAll.bind(document);


document.body.addEventListener("click", function(e) {
    if (e.target.classList.contains("js-modal-container")) {
        e.target.innerHTML = "";
        e.target.classList.remove("modal--visible");
    }

    if (e.target.classList.contains("js-add-room")) {
        $(".js-modal-container").appendChild($(".js-add-room-tpl").content.cloneNode(true));
        $(".js-modal-container").classList.add("modal--visible");

        $(".js-add-room-input").focus();

        var searchRoomTimeout;
        $(".js-add-room-input").addEventListener("keyup", function() {
            searchRoomTimeout = setTimeout(function() {
                $(".js-add-room-info").textContent = "Please wait...";
                // Here, we should do AJAX stuff to try and find a room
                setTimeout(function() {
                    if ($(".js-add-room-input").value == "general") {
                        document.getElementsByClassName("js-add-room-info")[0].textContent = "This room exists, and you already joined it. Press Enter to view it."
                    }
                    else if ($(".js-add-room-input").value == "minecraft") {
                        document.getElementsByClassName("js-add-room-info")[0].textContent = "This room exists. Press Enter to view it. If it is public or unlisted, you'll be able to join it."
                    }

                    else {
                        document.getElementsByClassName("js-add-room-info")[0].textContent = "This room doesn't exist. Press Enter to create it."
                    }
                }, 800);
            }, 500)
        })

        $(".js-add-room-input").addEventListener("keydown", function() {
            clearTimeout(searchRoomTimeout);
        }) 
    }
});

document.body.addEventListener("keyup", function(e) {
    if (e.key == "Escape") {
        $(".js-modal-container").innerHTML = "";
        $(".js-modal-container").classList.remove("modal--visible");
    }
})