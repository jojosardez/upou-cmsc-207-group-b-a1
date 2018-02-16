var reset = function () {
  var usernameOrEmail = document.getElementById('usernameOrEmail').value;

  $.ajax({
    type: "POST",
    url: "/api/forgot.php",
    data: JSON.stringify({
      usernameOrEmail: usernameOrEmail
    }),
    success: function (result) {
      ons.notification.alert(result);
    },
    contentType: "application/json; charset=utf-8",
    dataType: "json"
  });
};