var change = function () {
    var currentPassword = document.getElementById('currentPassword').value;
    var newPassword = document.getElementById('newPassword').value;
    var newPasswordRepeat = document.getElementById('newPasswordRepeat').value;

  
  if (validateInputPassword(currentPassword, newPassword, newPasswordRepeat)) {
    changeProcess(username, currentPassword, newPassword, newPasswordRepeat);
  }
}

var validateInputPassword = function (currentPassword, newPassword, newPasswordRepeat) {
  if (currentPassword === "" || newPassword === "" || newPasswordRepeat === "") {
    ons.notification.alert("Please provide your current password and enter a new password.", { title: "Change password failed!" });
    return false;
    } else if (password != repeatPassword) {
      ons.notification.alert("Passwords provided should match.", { title: "Change password failed!" });
      return false;
    } else if (!validatePassword(newPassword)) {
      errorMessage = "Password must contain at least 1 uppercase letter, 1 lowercase letter, 1 number, 1 special character, and must be between 8 and 20 characters in length.";
      return false
    }
  return true;
}


var changeProcess = function (username, currentPassword, newPassword, newPasswordRepeat) {
  $.ajax({
    type: "POST",
    url: "../api/change.php",
    data: JSON.stringify({
      username: $_SESSION["user"],
      currentPassword: currentPassword,
      newPassword: newPassword
    }),
    success: function (result) {
      hideModal();
      var success = result['success'] === true;
      if (success) {
        location.href = 'dashboard.php'
      }
        else {
          ons.notification.alert(result['message'],
            { title: "Incorrect password!" });
        };

    contentType: 'application/json; charset=utf-8',
    dataType: 'json'
  });
  }


