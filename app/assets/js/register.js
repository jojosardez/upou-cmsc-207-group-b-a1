var register = function () {
  var username = document.getElementById('username').value;
  var password = document.getElementById('password').value;
  var email = document.getElementById('email').value;

  $.ajax({
    type: 'POST',
    url: '/api/register.php',
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
            : 'Registration Failed!'
        });
    },
    contentType: 'application/json; charset=utf-8',
    dataType: 'json'
  });
};