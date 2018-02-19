var change = function () {
    var username = document.getElementById('username').value;
    var currentPassword = document.getElementById('currentPassword').value;
    var newPassword = document.getElementById('newPassword').value;
  
    $.ajax({
      type: "POST",
      url: "/api/change.php",
      data: JSON.stringify({
        username: username,
        currentPassword: currentPassword,
        newPassword: newPassword
      }),
      success: function (result) {
        ons.notification.alert(result);
      },
      contentType: "application/json; charset=utf-8",
      dataType: "json"
    });
  };