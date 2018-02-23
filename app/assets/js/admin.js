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
                    list.appendChild(onsItem);
                });
              
            },

            dataType: "json"
        });
    }
});