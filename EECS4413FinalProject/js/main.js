document.addEventListener("DOMContentLoaded", function () {
  var quickDivs = document.querySelectorAll(".quick");
  quickDivs.forEach(function (div) {
    div.addEventListener("click", function (event) {
      if (event.target.tagName.toLowerCase() === "button") {
        var value = div.querySelector("input[type=hidden]").value;
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "backend/controller/orderAjax.php", true);
        xhr.setRequestHeader(
          "Content-Type",
          "application/x-www-form-urlencoded"
        );
        xhr.onreadystatechange = function () {
          if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            console.log(this.responseText);
          }
        };
        xhr.send("inputValue=" + encodeURIComponent(value));
      }
    });
  });
});
