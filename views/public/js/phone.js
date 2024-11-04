document.addEventListener("DOMContentLoaded", function () {
  const phoneInputField = document.querySelector("#phone");

  if (phoneInputField) {
    window.intlTelInput(phoneInputField, {
      initialCountry: "jo",
      geoIpLookup: function (callback) {
        fetch("https://ipinfo.io/json?token=YOUR_API_TOKEN")
          .then((response) => response.json())
          .then((data) => callback(data.country))
          .catch(() => callback("JO"));
      },
      utilsScript:
        "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/utils.js",
    });

    // Event listener to restrict input to numbers only
    phoneInputField.addEventListener("input", function () {
      this.value = this.value.replace(/\D/g, ""); // Remove any non-numeric characters
    });
  }
});
