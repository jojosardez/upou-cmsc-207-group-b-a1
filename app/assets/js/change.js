var pageInitialized = false;

document.addEventListener("init", function (event) {
  if (pageInitialized) return;
  pageInitialized = true;

  showModal();
  $.ajax({
    type: "POST",
    url: "../api/session.php",
    data: null,
    success: function (result) {
      hideModal();
      setUserDisplay(result['user']);
    },
    contentType: "application/json; charset=utf-8",
    dataType: "json"
  });
});

var change = function () {
  showModal();
  var currentPassword = document.getElementById('currentPassword').value;
  var newPassword = document.getElementById('newPassword').value;
  var newPasswordRepeat = document.getElementById('newPasswordRepeat').value;

  if (validateInput(currentPassword, newPassword, newPasswordRepeat)) {
    changePassword(currentPassword, newPassword);
  }
};

var validateInput = function (currentPassword, newPassword, newPasswordRepeat) {
  var errorMessage = "";
  if (currentPassword === "") {
    errorMessage = "Current password should not be empty.";
  } else if (newPassword === "") {
    errorMessage = "New password should not be empty.";
  } else if (!validatePassword(newPassword)) {
    errorMessage = "New password must contain at least 1 uppercase letter, 1 lowercase letter, 1 number, 1 special character, and must be between 8 and 50 characters in length.";
  } else if (newPasswordRepeat === "") {
    errorMessage = "Repeat new password should not be empty.";
  } else if (newPassword != newPasswordRepeat) {
    errorMessage = "Passwords provided should match.";
  }

  if (errorMessage === "") {
    return true;
  } else {
    hideModal();
    ons.notification.alert(errorMessage, {
      title: "Invalid Input!"
    });
    return false;
  }
}

var changePassword = function (currentPassword, newPassword) {
  $.ajax({
    type: "POST",
    url: "../api/change.php",
    data: JSON.stringify({
      currentPassword: currentPassword,
      newPassword: newPassword
    }),
    success: function (result) {
      var success = result['success'] === true;
      hideModal();
      ons.notification.alert(
        result['message'], {
          title: success ?
            'Success!' : 'Failed!',
          callback: function () {
            if (success) {
              logout();
            }
          }
        });
    },
    error: function (xhr) {
      hideModal();
      console.log(xhr);
    },
    contentType: "application/json; charset=utf-8",
    dataType: "json"
  });
};