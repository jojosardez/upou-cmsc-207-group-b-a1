window.fn = {};

window.fn.open = function () {
  var menu = document.getElementById('menu');
  menu.open();
};

var showModal = function () {
  var modal = document.querySelector('ons-modal');
  modal.show();
}

var hideModal = function () {
  var modal = document.querySelector('ons-modal');
  modal.hide();
}

var goBack = function () {
  window.history.back();
}

var validateUsername = function (username) {
  var re = /^([a-zA-Z0-9 _-]{5,30})$/;
  return re.test(username);
}

var validateEmail = function (email) {
  var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(String(email).toLowerCase());
}

var validatePassword = function (password) {
  var re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,20})/;
  return re.test(password);
}

var setUserDisplay = function (username) {
  var userDiv = document.getElementById('currentUser');
  var onsUserIcon = document.createElement('ons-icon');
  onsUserIcon.setAttribute('icon', 'md-account-circle');
  onsUserIcon.setAttribute('style', "margin-right: 5px;");
  userDiv.appendChild(onsUserIcon);
  userDiv.appendChild(document.createTextNode(username));
}

var logout = function (showconfirm) {
  if (showconfirm) {
    ons.notification.confirm({
      message: 'Are you sure you want to logout?',
      callback: function (answer) {
        if (answer == 1) {
          logoutProceed();
        }
      }
    });
  } else {
    logoutProceed();
  }
};

var logoutProceed = function () {
  $.ajax({
    type: "GET",
    url: "../api/logout.php",
    success: function (result) {
      location.href = 'login.php';
    },
    contentType: "application/json; charset=utf-8",
    dataType: "json"
  });
}