var id = 0,
  prevEmail = '';

document.addEventListener("init", function (event) {
  var getId = window.location.search.substr(1).split("=")[1];

  if (getId != undefined) {
    id = getId;

    $.ajax({
      type: 'POST',
      url: '../api/getUser.php',
      data: JSON.stringify({
        id: id
      }),
      success: function (result) {
        document.getElementById('username').value = result[0].username;
        document.getElementById('email').value = result[0].email;
        document.getElementById('active').checked = String(result[0].active) === "1";
        document.getElementById('admin').checked = String(result[0].admin) === "1";
        prevEmail = result[0].email;
      },
      error: function (error) {
        console.log(error);
      },
      contentType: 'application/json; charset=utf-8',
      dataType: 'json'
    });
  }
});

var save = function () {
  showModal();
  var username = document.getElementById('username').value;
  var email = document.getElementById('email').value;
  var active = 1;
  var admin = 0;
  var password = '',
    repeatPassword = '';

  if (id === 0) {
    password = document.getElementById('password').value;
    repeatPassword = document.getElementById('repeatPassword').value;
  } else {
    active = document.getElementById('active').checked ? 1 : 0;
    admin = document.getElementById('admin').checked ? 1 : 0;
  }

  if (validateInput(username, password, repeatPassword, email)) {
    registerAccount(username, password, email, active, admin);
  }
};

var validateInput = function (username, password, repeatPassword, email) {
  var errorMessage = "";
  if (username === "") {
    errorMessage = "Username should not be empty.";
  } else if (!validateUsername(username)) {
    errorMessage = "Username must only contain letters, numbers, dash, underscore, and must be between 5 and 30 characters in length.";
  } else if (email === "") {
    errorMessage = "Email address should not be empty.";
  } else if (!validateEmail(email)) {
    errorMessage = "Email address provided is invalid.";
  } else if (id === 0) {
    if (password === "") {
      errorMessage = "Password should not be empty.";
    } else if (!validatePassword(password)) {
      errorMessage = "Password must contain at least 1 uppercase letter, 1 lowercase letter, 1 number, 1 special character, and must be between 8 and 20 characters in length.";
    } else if (repeatPassword === "") {
      errorMessage = "Repeat password should not be empty.";
    } else if (password != repeatPassword) {
      errorMessage = "Passwords provided should match.";
    }
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

var registerAccount = function (username, password, email, active, admin) {

  $.ajax({
    type: 'POST',
    url: '../api/register.php',
    data: JSON.stringify({
      username: username,
      password: password,
      email: email,
      id: id,
      prevEmail: prevEmail,
      active: active,
      admin: admin
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
              if (id === 0) {
                document.location.href = "../app/login.php";
              } else {
                document.location.href = "../app/dashboard.php";
              }
            }
          }
        });
    },
    error: function (xhr) {
      hideModal();
      console.log(xhr);
    },
    contentType: 'application/json; charset=utf-8',
    dataType: 'json'
  });
}