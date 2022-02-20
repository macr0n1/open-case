var slotsblock = document.querySelector('.slots');
var slots;
var btn = document.getElementById("opencase-btn");
var randomtarget;
var prizes = Array(500, 250, 100, 50, 20);
var rendertimes = 100;

var renderedprizes = Array();

function generate() {
  
  for(var i = 1; i <= rendertimes; i++) {
    var picholder = document.getElementById("slots");

    var div = document.createElement("div");
    div.className = "slots-prize";
    picholder.appendChild(div);

    var p = document.createElement("p");
    p.className = "slots-prize-text";
    var prizevalue = prizes[Math.floor(Math.random()*prizes.length)] + "$";
    p.textContent = prizevalue;
     div.appendChild(p);
    renderedprizes.push(prizevalue);
  }
  slots = document.querySelectorAll('.slots > div');
}


function start() {

  if (document.cookie.split(';').filter((item) => item.includes('user=')).length) {
    if (btn.innerHTML == "open")
    {
      slotsblock.style.transition = "20s cubic-bezier(0.51, 0.07, 0.34, 1.02)";
      randomtarget = Math.floor(Math.random() * (rendertimes - 5) );;
      slotsblock.style.right = randomtarget * 107.5 + "px";

      randomtarget+=2;
      var targetvalue = renderedprizes[randomtarget];
      console.log(targetvalue);

      // $.ajax({
      //   url:      "handler.php", //url страницы (action_ajax_form.php)
      //   type:     "POST", //метод отправки
      //   dataType: "html",
      //   data:     {"targetvalue":targetvalue},  // Сеарилизуем объект
      //   success: function(response) {
      //     alert(response);
      //     window.open("handler.php");
      //   }
      // });

      btn.disabled = true;
      btn.style.color = "gray";
      btn.style.cursor = "default";
      setTimeout(function() {
        btn.disabled = false;
        btn.style.color = "lightgray";
        btn.style.cursor = "pointer";
        
        slots[randomtarget].style.background = "#111521";
        btn.innerHTML = "reset";
      }, 20000);
    } else {
      slotsblock.style.transition = "1s cubic-bezier(0.51, 0.07, 0.34, 1.02)";
      slotsblock.style.right = "0px";
      slots[randomtarget].style.background = "#191e2f";

      btn.disabled = true;
      btn.style.color = "gray";
      btn.style.cursor = "default";
      setTimeout(function() {
        btn.disabled = false;
        btn.style.color = "lightgray";
        btn.style.cursor = "pointer";
        btn.innerHTML = "open";
      }, 1000);
    }
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
  }
}