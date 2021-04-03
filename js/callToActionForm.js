// collect form data
const form = document.getElementById("callToActionForm");
const name = document.getElementById("name2");
const phoneNumber = document.getElementById("phone2");
const clientLocation = document.getElementById("location");
const otherLocation = document.getElementById("ChoseOtherLocation");
const successMsg = "";
const errorMsg = "";
const submitBtn = document.getElementById("sendMessageButton2");
const endPointURL = "mail/starter.php?action=SendMail";
const xhr = new XMLHttpRequest();
const formData = new FormData();

// check the form data before appending
clientLocation.addEventListener("change", function () {
  if (this.value == 1) {
    document.getElementById("otherLocationContainer").style.display = "block";
  } else {
    document.getElementById("otherLocationContainer").style.display = "none";
  }
});
form.addEventListener("submit", function (e) {
  e.preventDefault();

  // append data
  // name
  formData.append("data[]", name.value);
  // phone number
  formData.append("data[]", phoneNumber.value);
  // location
  formData.append("data[]", clientLocation.value);
  //other location
  formData.append("data[]", otherLocation.value);

  xhr.open("POST", endPointURL, true);
  xhr.send(formData);

  xhr.onreadystatechange = function () {
    if (this.status === 200 && this.readyState === 4) {
      const dataObj = JSON.parse(xhr.responseText);
      if (dataObj.answer == "yes") {
        let modalHeader = document.getElementById(
          "bookAppointmentPopUp-header"
        );
        let modalBody = document.getElementById("modal-body-form");
        // change the modal header h2 text
        modalHeader.innerHTML = "Thank You!";
        // change the modal body
        let pText = document.createElement("p");
        pText.innerHTML =
          "A manager will be in contact with you soon to help book your appointment.";
        modalBody.innerHTML = "";
        modalBody.append(pText);
        let dismissBtn = document.getElementById("dismissBtn");
        dismissBtn.addEventListener("click", function () {
          location.reload();
        });
      }
    }
  };
});
