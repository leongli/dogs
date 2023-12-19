// Execute the provided function when the DOM is fully loaded
document.addEventListener("DOMContentLoaded", function () {
  // Get all elements with the class "quick"
  var quickDivs = document.querySelectorAll(".quick");
  // Iterate through each "quick" div
  quickDivs.forEach(function (div) {
    // Add a click event listener to each "quick" div
    div.addEventListener("click", function (event) {
      // Check if the clicked element is a button
      if (event.target.tagName.toLowerCase() === "button") {
        // Get the value of the hidden input inside the clicked div
        var value = div.querySelector("input[type=hidden]").value;
        // Create a new XMLHttpRequest for making asynchronous requests
        var xhr = new XMLHttpRequest();
        // Configure the request with POST method to the specified URL
        xhr.open("POST", "backend/controller/orderAjax.php", true);
        // Set the content type of the request to be sent
        xhr.setRequestHeader(
          "Content-Type",
          "application/x-www-form-urlencoded"
        );
        // Define the callback function to handle the response
        xhr.onreadystatechange = function () {
          // Check if the request is complete and successful
          if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            // Log the response text to the console
            console.log(this.responseText);
          }
        };
        // Send the request with the encoded input value
        xhr.send("inputValue=" + encodeURIComponent(value));
      }
    });
  });
});
