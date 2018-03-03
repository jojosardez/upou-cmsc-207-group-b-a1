var reset = function () {
  showModal();
  var usernameOrEmail = document.getElementById('usernameOrEmail').value;

  if (usernameOrEmail === "") {
    hideModal();
    ons.notification.alert("Username or email address should not be empty.", { title: "Invalid Input!" });
  }
  else {
    $.ajax({
      type: "POST",
      url: "../api/forgot.php",
      data: JSON.stringify({
        usernameOrEmail: usernameOrEmail
      }),
      success: function (result) {
        var success = result['success'] === true;
        hideModal();
        ons.notification.alert(
          result['message'],
          {
            title: success
              ? 'Password Reset Request Success!'
              : 'Password Reset Request Failed!',
            callback: function () {
              if (success) {
                document.location.href = "../app/login.php";
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
  }
};