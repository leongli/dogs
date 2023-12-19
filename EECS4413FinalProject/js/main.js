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
        // Create a button to store the event target
        var button = event.target;
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
          // Check if the request is completed
          if (this.readyState === XMLHttpRequest.DONE) {
            if (this.status === 200) {
              // Log the response text to the console
              console.log(this.responseText);
              // Change the button text to "Added" temporarily
              button.textContent = "Added";
              // Disable the button temporarily to prevent multiple clicks
              button.disabled = true;
              // Reset the button text and enable it after 2000 milliseconds (2 seconds)
              setTimeout(function () {
                button.textContent = "Quick Add to Cart";
                button.disabled = false;
              }, 750);
            } else {
              // Handle errors or other statuses here
              console.error("Error occurred:", this.status, this.statusText);
            }
          }
        };
        // Send the request with the encoded input value
        xhr.send("inputValue=" + encodeURIComponent(value));
      }
    });
  });
});
