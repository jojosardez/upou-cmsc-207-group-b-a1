var login = function () {
  showModal();
  var username = document.getElementById('username').value;
  var password = document.getElementById('password').value;

  if (validateInput(username, password)) {
    loginProcess(username, password);
  }
}

var validateInput = function (username, password) {
  if (username === "" || password === "") {
    hideModal();
    ons.notification.alert("Please provide your username and password.", { title: "Login failed!" });
    return false;
  }
  return true;
}

var loginProcess = function (username, password) {
  $.ajax({
    type: "POST",
    url: "../api/login.php",
    data: JSON.stringify({
      username: username,
      password: password
    }),
    success: function (result) {
      hideModal();
      var success = result['success'] === true;
      if (success) {
        location.href = 'dashboard.php'
      }
      else {
        if (result['errorcode'] === 2000) {
          ons.notification.confirm(
            {
              message: result['message'],
              title: 'Account Locked!',
              buttonLabels: ['Yes', 'No'],
              callback: function (answer) {
                if (answer === 0) {
                  alert("TO DO: unlock via email");
                }
              }
            });
        }
        else {
          ons.notification.alert(result['message'],
            { title: "Login failed!" });
        }
      }
    },
    error: function (xhr) {
      hideModal();
      console.log(xhr);
    },
    contentType: "application/json; charset=utf-8",
    dataType: "json"
  });
}