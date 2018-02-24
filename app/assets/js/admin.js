document.addEventListener("init", function (event) {
    var list = document.getElementById('usersList');

    if (list) {
        $.ajax({
            type: "GET",
            url: "../api/admin.php",
            success: function (result) {
                $.each(result, function(index, element) {
                   var onsItem = document.createElement('ons-list-item');
                    onsItem.setAttribute('modifier', "chevron");
                    onsItem.setAttribute('onclick', "functionName()");
                    onsItem.innerHTML = element['username'] + ' (' + element['email'] + ')';

                    var div = document.createElement('div');  
                    div.setAttribute('class', "right");

                    var editButton = document.createElement('ons-button');  
                    editButton.setAttribute('onclick', "location.href = 'register.php'"); 
                    editButton.innerHTML = "Edit";
                    div.appendChild(editButton);

                    var delButton = document.createElement('ons-button');  
                    delButton.setAttribute('onclick', "location.href = 'register.php'"); 
                    delButton.innerHTML = "Delete";
                    div.appendChild(delButton);
                    onsItem.appendChild(div);

                    list.appendChild(onsItem);
                });
              
            },

            dataType: "json"
        });
    }
});

var add = function () {
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