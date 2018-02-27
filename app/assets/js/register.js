document.addEventListener("init", function (event) {
var id = window.location.search.substr (1).split ("=")[1];

if(id != undefined){
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
      error: function(error){
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
  var username = document.getElementById('username').value;
  var password = document.getElementById('password').value;
  var email = document.getElementById('email').value;

console.log("test x");
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
            : 'Registration Failed!'
        });
    },
    error: function(xhr){
       console.log(xhr);
    },
    contentType: 'application/json; charset=utf-8',
    dataType: 'json'
  });
};