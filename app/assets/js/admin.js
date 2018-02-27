document.addEventListener("init", function (event) {
  loadUsers();
});

var loadUsers = function () {
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
                  editButton.setAttribute('onclick', "location.href = 'register.php?id="+element['id']+"'"); 
                  editButton.innerHTML = "Edit";
                  div.appendChild(editButton);

                  var delButton = document.createElement('ons-button');  
                  delButton.setAttribute('onclick', "deleteUser("+element['id']+")"); 
                  delButton.innerHTML = "Delete";
                  div.appendChild(delButton);
                  onsItem.appendChild(div);
                  onsItem.setAttribute('id', element['id']);

                  list.appendChild(onsItem);
                });
              
            },

            dataType: "json"
        });
    }
};

var deleteUser = function (id) {
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
};
