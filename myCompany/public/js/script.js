// Checks if the fields of a form are not empty
(function () {
  "use strict";
  window.addEventListener(
    "load",
    function () {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName("needs-validation");
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function (form) {
        form.addEventListener(
          "submit",
          function (event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add("was-validated");
          },
          false
        );
      });
    },
    false
  );
})();

// Show or hide password of a form
var iconsPassword = document.querySelectorAll(".iconPassword");
var inputsPassword = document.querySelectorAll("input[type=password]");
for (let i = 0; i < iconsPassword.length; i++) {
  iconsPassword[i].addEventListener("click", () => {
    if (
      iconsPassword[i].className == "far fa-eye-slash py-1 iconPassword" &&
      inputsPassword[i].type == "password"
    ) {
      iconsPassword[i].className = "far fa-eye py-1 iconPassword";
      inputsPassword[i].type = "text";
    } else {
      iconsPassword[i].className = "far fa-eye-slash py-1 iconPassword";
      inputsPassword[i].type = "password";
    }
  });
}
