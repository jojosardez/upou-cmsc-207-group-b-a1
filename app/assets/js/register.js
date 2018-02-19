var register = function () {
  var username = document.getElementById('username').value;
  var password = document.getElementById('password').value;
  var email = document.getElementById('email').value;

  $.ajax({
    type: "POST",
    url: "/api/register.php",
    data: JSON.stringify({
      username: username,
      password: password,
      email: email
    }),
    success: function (result) {
      ons.notification.alert(result);
    },
    contentType: "application/json; charset=utf-8",
    dataType: "json"
  });
};