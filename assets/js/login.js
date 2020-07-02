// https://stackoverflow.com/a/7576660/10074924

document.addEventListener('invalid', function(e){
    e.target.classList.add("invalid");
}, true);