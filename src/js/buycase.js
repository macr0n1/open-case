


function buycase(el) {
    if (document.cookie.split(';').filter((item) => item.includes('user=')).length) {
        return true;
    }
    else {
        var modal = document.getElementById("opencase-modal");
        var span = document.getElementsByClassName("close")[0];
        modal.style.display = "block";
        span.onclick = function() {
            modal.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        return false;
    }
}