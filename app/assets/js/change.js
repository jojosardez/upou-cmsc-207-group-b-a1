var pageInitialized = false;

document.addEventListener("init", function (event) {
  if (pageInitialized) return;
  pageInitialized = true;

  showModal();
  $.ajax({
    type: "POST",
    url: "../api/session.php",
    data: null,
    success: function (result) {
      hideModal();
      setUserDisplay(result['user']);
    },
    contentType: "application/json; charset=utf-8",
    dataType: "json"
  });
});

var change = function () {
  var currentPassword = document.getElementById('currentPassword').value;
  var newPassword = document.getElementById('newPassword').value;
  var newPasswordRepeat = document.getElementById('newPasswordRepeat').value;

  $.ajax({
    type: "POST",
    url: "../api/change.php",
    data: JSON.stringify({
      username: "TO DO: get from session",
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