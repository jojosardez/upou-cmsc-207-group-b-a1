document.addEventListener("init", function (event) {
  loadUsers();
});

var loadUsers = function () {
    var list = document.getElementById('usersList');
    var register = document.getElementById('registerButton');
    var userDetail = document.getElementById('userDetail');

    if (list) {
        $.ajax({
            type: "GET",
            url: "../api/admin.php",
            success: function (result) {
                var username = document.getElementById('currentUser');
                username.innerHTML = 'Current user: ' + result[0]['user'];

                if(result[0]['admin'] === "1")
                {
                list.setAttribute('style', "visibility: visible;"); 
                register.setAttribute('style', "visibility: visible;"); 

                $.each(result[1], function(index, element) {
                  var onsItem = document.createElement('ons-list-item');

                  var div = document.createElement('div');  
                  div.setAttribute('class', "right");

                  var centerDiv = document.createElement('div');  
                  centerDiv.setAttribute('class', "center");
                  centerDiv.innerHTML = element['username'] + ' (' + element['email'] + ')';

                  var leftDiv = document.createElement('div');  
                  leftDiv.setAttribute('class', "left");

                  var onsStatus = document.createElement('ons-icon');
                  onsStatus.setAttribute('icon', 'md-circle');
                  if (element['active'] === '1') onsStatus.setAttribute('style', 'color: green');
                  leftDiv.appendChild(onsStatus);

                  var editButton = document.createElement('ons-button');  
                  editButton.setAttribute('onclick', "location.href = 'edit.php?id="+element['id']+"'"); 
                  editButton.innerHTML = "Edit";
                  div.appendChild(editButton);

                  var delButton = document.createElement('ons-button');  
                  delButton.setAttribute('onclick', "deleteUser("+element['id']+")"); 
                  delButton.innerHTML = "Delete";
                  div.appendChild(delButton);

                  onsItem.appendChild(leftDiv);
                  onsItem.appendChild(centerDiv);
                  onsItem.appendChild(div);
                  onsItem.setAttribute('id', element['id']);

                  list.appendChild(onsItem);
                });
              }
              else{
                 userDetail.setAttribute('style', "visibility: visible;"); 
                 userDetail.innerHTML = "Welcome " + result[0]['user'] + '!';
              }
            },

            dataType: "json"
        });
    }
};

var deleteUser = function (id) {
  ons.notification.confirm({
    message: 'Are you sure you want to delete user?',
    callback: function(answer) {    
    if(answer == 1)
    {
      var list = document.getElementById('usersList');
      var item = document.getElementById(id);

      $.ajax({
        type: "POST",
        url: "../api/deleteUser.php",
        data: JSON.stringify({
          id: id,
        }),
        success: function (result) {
          list.removeChild(item);
        },
        contentType: "application/json; charset=utf-8",
        dataType: "json"
      });
    }
    }
  });
};

var logout = function(){
ons.notification.confirm({
    message: 'Are you sure you want to logout?',
    callback: function(answer) {    
    if(answer == 1)
    {
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
    }
  });
};
