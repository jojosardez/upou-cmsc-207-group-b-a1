document.addEventListener("init", function (event) {
  var id = window.location.search.substr(1).split("=")[1];

  if (id != undefined) {
    $.ajax({
      type: 'POST',
      url: '../api/getUser.php',
      data: JSON.stringify({
        id: id
      }),
      success: function (result) {
        console.log(result);
        document.getElementById('username').value = result[0].username;
        document.getElementById('email').value = result[0].email;
      },
      error: function (error) {
        console.log(error);
      },
      contentType: 'application/json; charset=utf-8',
      dataType: 'json'
    });

    //username.setAttribute('value', "AAAA");
    //console.log(username);

  }
});

var register = function () {
  var modal = document.querySelector('ons-modal');
  modal.show();
  var username = document.getElementById('username').value;
  var password = document.getElementById('password').value;
  var repeatPassword = document.getElementById('repeatPassword').value;
  var email = document.getElementById('email').value;

  if (validateInput(username, password, repeatPassword, email)) {
    registerAccount(username, password, email);
  }
  modal.hide();
};

var validateInput = function (username, password, repeatPassword, email) {
  var errorMessage = "";
  if (username === "") {
    errorMessage = "Username should not be empty.";
  }
  else if (username.length < 5 || username.length > 50) {
    errorMessage = "Username must be between 5 and 50 characters in length.";
  }
  else if (email === "") {
    errorMessage = "Email address should not be empty.";
  }
  else if (!validateEmail(email)) {
    errorMessage = "Email address provided is invalid.";
  }
  else if (password === "") {
    errorMessage = "Password should not be empty.";
  }
  else if (password.length < 5 || password.length > 50) {
    errorMessage = "Password must be between 5 and 50 characters in length.";
  }
  else if (repeatPassword === "") {
    errorMessage = "Repeat password should not be empty.";
  }
  else if (password != repeatPassword) {
    errorMessage = "Passwords provided should match.";
  }

  if (errorMessage === "") {
    return true;
  }
  else {
    ons.notification.alert(errorMessage, { title: "Invalid Input!" });
    return false;
  }
}

var validateEmail = function (email) {
  var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(String(email).toLowerCase());
}

var registerAccount = function (username, password, email) {
  $.ajax({
    type: 'POST',
    url: '../api/register.php',
    data: JSON.stringify({
      username: username,
      password: password,
      email: email
    }),
    success: function (result) {
      var success = result['success'] === true;
      ons.notification.alert(
        success
          ? 'In order to login to the application, you need to verify your account first. Please check your email for the verification link.'
          : result['message'],
        {
          title: success
            ? 'Registration Success!'
            : 'Registration Failed!',
          callback: function () {
            if (success) {
              document.location.href = "../app/login.php";
            }
          }
        });
    },
    error: function (xhr) {
      console.log(xhr);
    },
    contentType: 'application/json; charset=utf-8',
    dataType: 'json'
  });
}