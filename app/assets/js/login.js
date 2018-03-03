var login = function () {
  var username = document.getElementById('username').value;
  var password = document.getElementById('password').value;

  $.ajax({
    type: "POST",
    url: "../api/login.php",
    data: JSON.stringify({
      username: username,
      password: password
    }),
    success: function (result) {
      document.location.href = "../app/dashboard.php";
    },
    contentType: "application/json; charset=utf-8",
    dataType: "json"
  });
};