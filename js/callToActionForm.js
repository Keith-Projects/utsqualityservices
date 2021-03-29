// collect form data
const form = document.getElementById("callToActionForm");
const name = document.getElementById("name2");
const phoneNumber = document.getElementById("phone2");
const clientLocation = document.getElementById("location");
const otherLocation = document.getElementById("ChoseOtherLocation");
const successMsg = "";
const errorMsg = "";
const submitBtn = document.getElementById("sendMessageButton2");
const endPointURL = "mail/starter.php?action=testing";
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
  xhr.open("POST", endPointURL, true);
  xhr.send(formData);

  xhr.onreadystatechange = function () {
    if (this.status === 200 && this.readyState === 4) {
      // test and will be taken out in production
      alert(xhr.responseText);
      return false;
      const dataObj = JSON.parse(xhr.responseText);
      // message goes here
    }
  };
});
